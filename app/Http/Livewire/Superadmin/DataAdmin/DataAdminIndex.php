<?php

namespace App\Http\Livewire\Superadmin\DataAdmin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class DataAdminIndex extends Component
{   
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '',$row = 10,$status;
    public function search(){
        $this->render();
    }
    public function render()
    {   
        if($this->search){ 
            $users = User::whereHas('roles', function ($query)  {
                $query->where('name', 'admin');
            })->where('name', 'LIKE', '%'.$this->search.'%')
                ->orWhere('email', 'LIKE', '%'.$this->search.'%')
                ->latest()->paginate($this->row);
        }else{
            $users = User::latest()->paginate($this->row);
        }
  
        return view('livewire.superadmin.data-admin.data-admin-index',compact('users'));
    }
}
