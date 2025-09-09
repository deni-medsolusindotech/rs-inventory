<?php

namespace App\Http\Livewire\Superadmin\DataAdmin;

use App\Models\log;
use App\Models\lokasi;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class DataAdminTambah extends Component
{   
    use WithFileUploads;
    public $user,$avatar,$page = 'edit-profile';
    public $password,$email;
    protected $queryString = ['page'];
    public $role,$status = null;
    protected $rules = [
        'user.name' => 'required|min:3',
        'email' => 'required|unique:users',
        'user.nomor_hp' => 'required',
        'user.avatar' => 'nullable',
        'password' => 'nullable|min:6|alpha_num',
        'avatar' => 'nullable|mimes:gif,jpeg,png|max:2048',
        'status' => 'required'
    ];

    public function mount(){
        $this->user = User::make(); 
        $this->role = lokasi::all()->pluck('nama_lokasi');
    }
    public function updated($name){
        $this->validateOnly($name);
    }
    public function EditProfile(){
        $this->validate();
        $this->user->email = $this->email;
        $this->user->password = ($this->password) ? $this->password : 'digidukun.com';
        $this->user->avatar = ($this->avatar) ? $this->avatar->storeAs('profile','avatar-'.$this->user->id.uniqid().'.'.$this->avatar->extension(),'dokumen') 
                                              : null ;

        $this->user->save();
        $this->user->assignRole($this->status);
        log::create([
            'user_id' => auth()->user()->id,
            'table'   => 'users',
            'keterangan'=> 'Menambah User '.$this->user->name.' email '.$this->user->email.' Sebagai '.$this->status,
        ]);
        return redirect('/data-admin')->with('success','profile user '.$this->user->name.' berhasil di simpan');
    }
  

    public function render()
    {
        return view('livewire.superadmin.data-admin.data-admin-tambah');
    }
}
