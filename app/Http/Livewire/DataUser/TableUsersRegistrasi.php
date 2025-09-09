<?php

namespace App\Http\Livewire\DataUser;

use App\Models\Notifikasi;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TableUsersRegistrasi extends Component
{   
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '',$row = 10,$status,$selected = [];
    public function search(){
        $this->render();
    }

    public function konfirmasi($id,$status){
        $user = User::find($id);
        $user->update([
            'confirm' => $status,
            'confirm_at' => now()
        ]);
        $s = ($status) ? 'terima' : 'tolak';
        $this->notif($id,$status);
        // $user->notify(new SendNotificationVerificationRegistrasi($s));
        if($s == 'tolak'){
            $user->delete();
        }
        return redirect('/data-user')->with('success','data user berhasil '.$s);
    }
    public function konfirmasibanyak($status){
        User::whereIn('id', $this->selected)->update([
            'confirm' => $status,
            'confirm_at' => now()
        ]);
        $s = ($status) ? 'terima' : 'tolak';
        foreach($this->selected as $id){
            $user = User::find($id);
            $this->notif($user->id,$status);
            // $user->notify(new SendNotificationVerificationRegistrasi($s));
            if($s == 'tolak'){
                $user->delete();
            }
        }
        return redirect('/data-user')->with('success','data '.count($this->selected).' user berhasil '.$s);
    }

    public function notif($id,$status){
        $pesan = ($status) ? "Selamat, konfirmasi data registrasi anda di terima" : 'Mohon Maaf, konfirmasi data registrasi anda di tolak'; 
        $judul = ($status) ? "di terima" : 'di tolak'; 
        $color = ($status) ? "primary" : 'danger'; 
        Notifikasi::create([
            'user_id' => $id,
            'judul' => 'Konfirmasi Data Diri '.$judul,
            'pesan' => $pesan,
            'icon' => 'bx bx-user-circle',
            'color' => $color,
            'link' => '/profile'
        ]);
    }

    public function render()
    {   
        if($this->status != null){
            $confirm_at = ($this->status) ? "!=" : "";
            $users = User::latest()->where('confirm',false);
            if($this->search){
                $users = $users->where('confirm_at',$confirm_at,null)->where('name', 'LIKE', '%'.$this->search.'%')
                ->orWhere('email', 'LIKE', '%'.$this->search.'%')
                ->orWhere('nomor_hp', 'LIKE', '%'.$this->search.'%')
                ->orWhere('status_medis', 'LIKE', '%'.$this->search.'%')
                ->paginate($this->row);
            }else{
                $users = ($this->status) ? $users->where('confirm_at',"!=",null)->paginate($this->row) : $users->where('confirm_at',null)->paginate($this->row);
            }
        }elseif($this->search){
            $users = User::latest()->where('confirm',false)->where('name', 'LIKE', '%'.$this->search.'%')
            ->orWhere('email', 'LIKE', '%'.$this->search.'%')
            ->orWhere('nomor_hp', 'LIKE', '%'.$this->search.'%')
            ->orWhere('status_medis', 'LIKE', '%'.$this->search.'%')
            ->paginate($this->row);
        }else{
            $users = User::latest()->where('confirm',false)->paginate($this->row);
        }
        return view('livewire.data-user.table-users-registrasi',compact('users'));
    }
}
