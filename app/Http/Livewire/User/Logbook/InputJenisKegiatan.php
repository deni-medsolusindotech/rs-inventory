<?php

namespace App\Http\Livewire\User\Logbook;

use App\Models\Kegiatan;
use App\Models\LogbookPerawat;
use Livewire\Component;
use Illuminate\Support\Carbon;

class InputJenisKegiatan extends Component
{   
    public $jenis_logbook,$jenis_kegiatans,$kegiatans ,$logbook = [];
    public $listeners = ['tambah','setKegiatans','simpan'];
    protected $rules = ['logbook.*.kegiatan_id' => 'required' , 'logbook.*.no_rm' => 'required'];
    public function mount(){
        $today = Carbon::today();
        $logbook = LogbookPerawat::where('user_id',auth()->user()->id)->whereDate('created_at',$today)->get(['kegiatan_id','no_rm']);
        if($logbook->count()){
            $this->logbook = $logbook->toArray();
            $this->jenis_logbook = $logbook->first()->kegiatan->jenis_logbook;
        }else{
            $this->tambah();
        }
        $this->kegiatans = Kegiatan::where('jenis_logbook',auth()->user()->status->jenis_logbook)->get();
        $this->setKegiatans($this->jenis_logbook);
    }
    public function setKegiatans($jenis_logbook){
        $this->jenis_kegiatans = $this->kegiatans->where('jenis_logbook',$jenis_logbook);
        $this->select();
    }
    public function setValue($index,$val){
        $this->logbook[$index]['kegiatan_id'] = $val;
        $this->select();
    }
    public function tambah(){
        $this->logbook[] = ['kegiatan_id' => null,'no_rm' => null];
        $this->select();
    }
    public function hapus($index){
        unset($this->logbook[$index]);
        $this->logbook = array_values($this->logbook);
        $this->select();
    }
    public function select(){
        $this->render();
        $this->emit('select');
    }

    public function simpan(){
        $this->validate();
        $today = Carbon::today();
        LogbookPerawat::where('user_id',auth()->user()->id)->whereDate('created_at',$today)->delete();
        foreach($this->logbook as $logbook){
            LogbookPerawat::create([
                'user_id' => auth()->user()->id,
                'kegiatan_id' => $logbook['kegiatan_id'],
                'no_rm' => $logbook['no_rm'],
            ]);
        }
        return redirect('/log-book')->with('success','Input data logbook hari ini berhasil di simpan');
    }

    public function render()
    {
        return view('livewire.user.logbook.input-jenis-kegiatan');
    }
}
