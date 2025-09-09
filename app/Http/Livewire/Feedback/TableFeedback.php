<?php

namespace App\Http\Livewire\Feedback;

use App\Models\Feedback;
use App\Models\Notifikasi;
use App\Models\User;
use Livewire\Component;

class TableFeedback extends Component
{   
    public $page,$messageid,$users;
    public $allFeedback,$kontakMasuk,$terkirim,$notifikasi,$trash;
    public $feedback,$feedbackRead,$newFeedback;
    public $newFeedbackToUser,$keySearch,$searchResult = [];
    public $selectedBulk = [];
    public $queryString = ['page' => ['except' => ''],'messageid' => ['except' => '']];
    protected $rules = [
        'newFeedback.from' => 'required',
        'newFeedback.to' => 'required',
        'newFeedback.subject' => 'required',
        'newFeedback.message' => 'required',
    ];

    public function mount(){
        // set page menjadi kontak masuk jika page kosong
        if($this->page == ''){
            $this->page = 'kontak-masuk';
        }

        // dapatkan data yang dibutuhkan
        $this->allFeedback = Feedback::whereTo(auth()->user()->id)->orWhere('from',auth()->user()->id)->latest()->get();
        $this->kontakMasuk =  $this->allFeedback->filter(function ($item) {
                                return $item['to'] == auth()->user()->id && $item['deleteTo'] == false ;
                            });
        $this->terkirim = $this->allFeedback->filter(function ($item) {
                            return $item['from'] == auth()->user()->id && $item['deleteFrom'] == false ;
                        });
        $this->trash =  $this->allFeedback->filter(function ($item) {
                            return $item['deleteTo'] == true || $item['deleteFrom'] == true;
                        });
        $this->notifikasi = Notifikasi::whereUserId(auth()->user()->id)->latest()->get();

        // untuk mengatur read feedback
        if($this->messageid){
            if($this->page == 'notifikasi'){
                $this->feedback = Notifikasi::findOrFail($this->messageid);
                $this->feedback->update([
                    'read' => true
                ]);
            }else{
                $this->feedback = Feedback::findOrFail($this->messageid);
                $masuk = ($this->feedback->to == auth()->user()->id) ? true : false; 
                if($masuk){
                    $this->feedback->update([
                        'readTo' => true
                    ]);
                }else{
                    $this->feedback->update([
                        'readFrom' => true
                    ]);
                }
                $this->feedbackRead = $this->allFeedback->filter(function ($item) {
                    $tujuan = ($this->feedback->to == auth()->user()->id) ? $this->feedback->from : $this->feedback->to; 
                    return $item['to'] == $tujuan || $item['from'] == $tujuan;
                });
            }
           
        }

        // mendapatkan daftar user untuk feedback baru
        if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('super admin')){
            $this->users = User::where('id', '!=',auth()->user()->id)->get();
        }else{
            $this->users = User::where('id', '!=',auth()->user()->id)->WhereHas('roles', function ($query) {
                $query->where('name', 'admin')
                    ->orWhere('name', 'super_admin');
            })->get();
        }
    }


    // ketika attribute di ubah
    public function Updated($name){
        if($name == 'page'){
            $this->mount();
            if($this->page == 'baru'){
                $this->newFeedback = Feedback::make();
                $this->newFeedback->from = auth()->user()->id;
                $this->newFeedback->subject = 'Feedback';
            }
            $this->messageid = null;
        }
        if($name == 'newFeedback.to'){
            $this->newFeedbackToUser = $this->users->where('id',$this->newFeedback['to'])->first();
        }
    }

    // ketika tombol balas feedback di click
    public function replyFeedback($id){
        $this->page = 'baru';
        $this->newFeedback = Feedback::make();
        $this->newFeedback->from = auth()->user()->id;
        $this->newFeedback->subject = 'Feedback';
        $this->newFeedback->to = $id;
        $this->messageid = null;
        $this->newFeedbackToUser = $this->users->where('id',$id)->first();
    }

    // membuat / mengirim feedback baru
    public function sendFeedback(){
        try {
            $this->validate();
            $this->newFeedback->save();
            return redirect('/feedback?page=kontak-terkirim')->with('success','Feedback Berhasil Dikirim');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->emit('errors');
        }
    }

    // menghapus data banyak sekaligus
    public function bulkDelete(){
        if($this->page == 'kontak-masuk'){
            Feedback::whereIn('id', $this->selectedBulk)->update([
                'deleteTo' => true
            ]);
            return redirect('/feedback?page=kontak-masuk')->with('success','Beberapa data Feedback Masuk Berhasil dihapus dan Masuk Trash');
        }elseif($this->page == 'kontak-terkirim'){
            Feedback::whereIn('id', $this->selectedBulk)->update([
                'deleteFrom' => true
            ]);
            return redirect('/feedback?page=kontak-terkirim')->with('success','Beberapa data Feedback Terkirim Berhasil dihapus dan Masuk Trash');
        }
       
    }
    // Tandai Telah Dibaca data banyak sekaligus
    public function bulkRead(){
        if($this->page == 'kontak-masuk'){
            Feedback::whereIn('id', $this->selectedBulk)->update([
                'readTo' => true
            ]);
            return redirect('/feedback?page=kontak-masuk')->with('success','Beberapa data Feedback Masuk Berhasil Di Tandai Telah Di Baca');
        }elseif($this->page == 'kontak-terkirim'){
            Feedback::whereIn('id', $this->selectedBulk)->update([
                'readFrom' => true
            ]);
            return redirect('/feedback?page=kontak-terkirim')->with('success','Beberapa data Feedback Terkirim Berhasil Di Tandai Telah Di Baca');
        }elseif($this->page == 'notifikasi'){
            Notifikasi::whereUserId(auth()->user()->id)->where('read',false)->update([
                'read' => true
            ]);
            return redirect('/feedback?page=notifikasi')->with('success','Beberapa data notifikasi Berhasil Di Tandai Telah Di Baca');
        }
    }

    public function search()
    {   
        $query = $this->keySearch;
        $results = $this->allFeedback->filter(function ($item) use ($query) {
            // Sesuaikan dengan kriteria pencarian yang diinginkan.
            return stripos($item->message, $query) !== false
                || stripos($item->subject, $query) !== false
                || stripos($item->created_at->format('d F Y H:i'), $query) !== false
                || stripos($item->dari->email, $query) !== false
                || stripos($item->dari->nama, $query) !== false
                || stripos($item->tujuan->nama, $query) !== false
                || stripos($item->tujuan->email, $query) !== false;
        });

        $this->page = 'search';
        $this->searchResult = $results;
    }

}
