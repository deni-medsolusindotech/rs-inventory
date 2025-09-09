<?php

namespace App\Http\Livewire\DataUser;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class TableUsers extends Component
{   
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '',$row = 10,$status;
    public function search(){
        $this->render();
    }
    public function render()
    {   
        if($this->status){
            if($this->search){
                $users = User::where('konfirmasi','!=',null)->where('name', 'LIKE', '%'.$this->search.'%')
                ->orWhere('email', 'LIKE', '%'.$this->search.'%')
                ->orWhere('email', 'LIKE', '%'.$this->search.'%')
                ->orWhereHas('roles', function ($query)  {
                    $query->where('name', $this->search);
                })->whereHas('statusKonfirmasi', function ($query)  {
                    $query->where('status', $this->status);
                })->paginate($this->row);
            }else{
                $users = User::where('konfirmasi','!=',null)->whereHas('statusKonfirmasi', function ($query)  {
                    $query->where('status', $this->status);
                })->paginate($this->row);
            }
        }elseif($this->search){
            $users = User::where('konfirmasi','!=',null)->where('name', 'LIKE', '%'.$this->search.'%')
            ->orWhere('email', 'LIKE', '%'.$this->search.'%')
            ->orWhere('email', 'LIKE', '%'.$this->search.'%')
            ->orWhereHas('roles', function ($query)  {
                $query->where('name', $this->search);
            })->paginate($this->row);
        }else{
            $users = User::where('konfirmasi','!=',null)->paginate($this->row);
        }
    return view('livewire.data-user.table-users',compact('users'));
    }
}
