<?php

namespace App\Http\Livewire\User\PengajuanKebutuhan;


use App\Models\pengajuankebutuhan;
use App\Models\Produk;
use Livewire\Component;
use Livewire\WithPagination;

class UserPengajuanKebutuhan extends Component
{   
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search,$status;
    public $jumlah;
  
  

    public function render()
    {   
        $products = pengajuankebutuhan::where('lokasi_tujuan', auth()->user()->roles->first()->id)->latest();
        // Menerapkan filter pada pencarian
      
        if ($this->search) {
            $products->where(function ($query) {
                $query->where('nama_barang','like', '%'.$this->search.'%')
                ->orWhere('jenis','like', '%'.$this->search.'%')
                ->orWhere('deskripsi','like', '%'.$this->search.'%')
                ->orWhere('jumlah','like', '%'.$this->search.'%');
            });
        }
        if ($this->status) {
            $products->where(function ($query) {
                $query->WhereHas('confirmation', function ($query) {
                    $query->where('status', $this->status);
                });
            });
        }
        return view('livewire.user.pengajuan-kebutuhan.user-pengajuan-kebutuhan',[
            'produk' => $products->paginate(10)
        ]);
    }
}
