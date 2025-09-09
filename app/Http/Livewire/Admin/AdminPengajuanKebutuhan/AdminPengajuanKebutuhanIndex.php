<?php

namespace App\Http\Livewire\Admin\AdminPengajuanKebutuhan;

use App\Models\pengajuankebutuhan;
use Livewire\Component;
use Livewire\WithPagination;

class AdminPengajuanKebutuhanIndex extends Component
{   
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search,$status;
   

    public function render()
    {   
        $pengajuan = pengajuankebutuhan::latest();
      
        if ($this->search) {
            $pengajuan->where(function ($query) {
                $query->where('nama_barang','like', '%'.$this->search.'%')
                ->orWhere('jenis','like', '%'.$this->search.'%')
                ->orWhere('deskripsi','like', '%'.$this->search.'%')
                ->orWhere('jumlah','like', '%'.$this->search.'%')
                ->orWhereHas('by', function ($query) {
                    $query->where('name','like', '%'.$this->search.'%');
                });
            });
        }
        if ($this->status) {
            $pengajuan->where(function ($query) {
                $query->WhereHas('confirmation', function ($query) {
                    $query->where('status', $this->status);
                });
            });
        }
        return view('livewire.admin.admin-pengajuan-kebutuhan.admin-pengajuan-kebutuhan-index',[
            'pengajuan' => $pengajuan->paginate()
        ]);
    }
}
