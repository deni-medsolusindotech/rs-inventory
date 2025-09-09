<?php

namespace App\Http\Livewire\Profile;

use App\Models\log;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileEdit extends Component
{   use WithFileUploads;
    public $user,$avatar,$page = 'edit-profile';
    public $password,$password_baru,$password_baru_confirmation;
    public $rules = [];
    protected $queryString = ['page'];
    protected $ruleProfile = [
        'user.name' => 'required|min:3',
        'user.email' => 'required',
        'user.nomor_hp' => 'required',
        'user.avatar' => 'required',
        'avatar' => 'nullable|mimes:gif,jpeg,png|max:2048'
    ];
    protected $rulePassword = [
        'password' => 'required',
        'password_baru' => 'required|min:6|alpha_num|confirmed',
        'password_baru_confirmation' => 'required|min:6|alpha_num', 
    ];

    public function mount(){
        $this->edit($this->page);
        $user = User::whereId(auth()->user()->id)->first();
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
            'keterangan'=> 'Edit Profile'
        ]);
        return redirect('/dashboard')->with('success','profile berhasil di edit');
    }
    public function EditPassword(){
        $this->validate();
        $password = Hash::check($this->password,auth()->user()->password);
        if($password){
           User::whereId($this->user->id)->update([
                'password' => Hash::make($this->password_baru),
           ]);
           log::create([
                'user_id' => auth()->user()->id,
                'table'   => 'users',
                'keterangan'=> 'Edit Password'
            ]);
            return redirect('/dashboard')->with('success','password berhasil di edit');
        }else{
            throw ValidationException::withMessages(['password' => ['password lama tidak sama.'],]);
        }
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
        return view('livewire.profile.profile-edit');
    }
}
