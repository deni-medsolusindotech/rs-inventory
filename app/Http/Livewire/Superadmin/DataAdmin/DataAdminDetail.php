<?php

namespace App\Http\Livewire\Superadmin\DataAdmin;

use App\Models\log;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class DataAdminDetail extends Component
{   
    use WithFileUploads;
    public $user,$avatar,$page = 'edit-profile';
    public $password,$password_baru,$password_baru_confirmation;
    public $rules = [];
    protected $queryString = ['page'];
    protected $ruleProfile = [
        'user.name' => 'required|min:3',
        'user.email' => 'required|email',
        'user.nomor_hp' => 'required',
        'user.avatar' => 'required',
        'avatar' => 'nullable|mimes:gif,jpeg,png|max:2048'
    ];
    protected $rulePassword = [
        'password_baru' => 'required|min:6|alpha_num|confirmed',
        'password_baru_confirmation' => 'required|min:6|alpha_num', 
    ];

    public function mount($id){
        $this->edit($this->page);
        $user = User::findOrFail($id);
        $this->user = ($user) ? $user : User::make(); 
    }
    public function updated($name){
        $this->validateOnly($name);
        if($name == 'page'){
            $this->edit($this->page);
        }
    }
    public function EditProfile(){
        $this->validate();
        $this->user->avatar = ($this->avatar) ? $this->avatar->storeAs('profile','avatar-'.$this->user->id.uniqid().'.'.$this->avatar->extension(),'dokumen') 
                                              : $this->user->avatar ;
        $this->user->save();
        log::create([
            'user_id' => auth()->user()->id,
            'table'   => 'users',
            'keterangan'=> 'Mengedit Profile User '.$this->user->name.' email '.$this->user->email.' Sebagai '.$this->status,
        ]);
        return redirect('/data-admin')->with('success','profile user admin '.$this->user->name.' berhasil di edit');
    }
    public function EditPassword(){
        $this->validate();
        User::whereId($this->user->id)->update([
            'password' => Hash::make($this->password_baru),
       ]);
       log::create([
            'user_id' => auth()->user()->id,
            'table'   => 'users',
            'keterangan'=> 'Mengedit Password User '.$this->user->name.' email '.$this->user->email.' Sebagai '.$this->status,
        ]);
        return redirect('/data-admin')->with('success','password user admin '.$this->user->name.' berhasil di edit');
    }

    public function edit($nama){
        if($nama == 'edit-profile'){
            $this->rules = $this->ruleProfile;
        }else if($nama == 'edit-password'){
            $this->rules = $this->rulePassword;
        }
    }
    public function render()
    {
        return view('livewire.superadmin.data-admin.data-admin-detail');
    }
}
