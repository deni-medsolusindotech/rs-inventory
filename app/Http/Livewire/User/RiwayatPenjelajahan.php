<?php

namespace App\Http\Livewire\User;

use App\Models\log;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RiwayatPenjelajahan extends Component
{   use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search,$date_filter,$user_filter,$auth_filter,$users,$auth,$semua;

    public function mount(){
        $this->auth = Role::all();
        $this->users = User::all();
    }

    public function updated($name){
        if($name == 'auth_filter'){
            if($this->auth_filter){
                $role = Role::find($this->auth_filter);
                $this->users = $role->users;
            }
        }
    }

    public function render()
    {   
        $log = log::whereUserId(auth()->user()->id)->latest();
         if ($this->search) {
            $log->where('keterangan','like', '%'.$this->search.'%')
                ->orWhere('created_at','like', '%'.$this->search.'%');
        }
         if ($this->date_filter) {
            $log->where('created_at','like', '%'.$this->date_filter.'%');
        }

        $log_all = log::latest();
         if ($this->search) {
            $log_all->where('keterangan','like', '%'.$this->search.'%')
                ->orWhere('created_at','like', '%'.$this->search.'%')
                ->orWhereHas('user',function($query){
                    $query->where('name','like','%'.$this->search.'%');
                })->orWhereHas('user.roles',function($query){
                    $query->where('name','like','%'.$this->search.'%');
                });
        }
         if ($this->date_filter) {
            $log_all->where('created_at','like', '%'.$this->date_filter.'%');
        }
        if ($this->user_filter) {
            $log_all->where('user_id',$this->user_filter);
        }
        if ($this->auth_filter) {
            $log_all->whereHas('user',function ($query){
                    $query->whereHas('roles',function($query){
                        $query->where('id',$this->auth_filter);
                    });
                });
        }
       
        return view('livewire.user.riwayat-penjelajahan',[
            'log' => $log->paginate(100),
            'log_all' => $log_all->paginate(100),
        ]);
    }
}
