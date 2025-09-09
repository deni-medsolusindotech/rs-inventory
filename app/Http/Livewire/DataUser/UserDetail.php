<?php

namespace App\Http\Livewire\DataUser;

use App\Models\Notifikasi;
use App\Models\User;
use Livewire\Component;

class UserDetail extends Component
{   
    public $user,$identifier;
    public $listeners = ['search' => ['except' => '']];
    public function mount($email){
        $this->identifier = $email;
        $this->user = User::whereEmail($email.'@gmail.com')->FirstOrFail();
    }
    public function terima(){
        $this->user->statusKonfirmasi->update([
            'status' => 'terima',
            'author' => auth()->user()->id
        ]);
        Notifikasi::create([
            'user_id' => $this->user->id,
            'judul' => 'Konfirmasi Data Diri Diterima',
            'pesan' => 'Selamat, konfirmasi data diri anda di terima oleh '.auth()->user()->email,
            'icon' => 'bx bx-user-circle',
            'color' => 'primary',
            'link' => '/profile'
        ]);
        return redirect('/data-user/'.$this->identifier.'/detail')->with('success','Konfirmasi data user '.$this->user->ktp->nama.' berhasil di terima');
    }

    public function tolak($alasan){
        $this->user->statusKonfirmasi->update([
            'status' => 'tolak',
            'alasan' => $alasan,
            'author' => auth()->user()->id
        ]);
        Notifikasi::create([
            'user_id' => $this->user->id,
            'judul' => 'Konfirmasi Data Diri Ditolak',
            'pesan' => 'Mohon Maaf, konfirmasi data diri anda di tolak oleh '.auth()->user()->email .'.Dengan alasan n/' .$alasan,
            'icon' => 'bx bx-user-circle',
            'color' => 'danger',
            'link' => '/profile'
        ]);
        return redirect('/data-user/'.$this->identifier.'/detail')->with('success','Konfirmasi data user '.$this->user->ktp->nama.' berhasil di tolak');
    }


    public function render()
    {
        return view('livewire.data-user.user-detail');
    }
}
