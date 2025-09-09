<?php

namespace App\Http\Livewire\User\PengajuanKerusakan;

use App\Models\pengajuankerusakan;
use Livewire\Component;
use Livewire\WithPagination;

class UserPengajuanKerusakanIndex extends Component
{   
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search,$status;
    public $jumlah;
  
   

    public function render()
    {   
        $produk = pengajuankerusakan::whereHas('produkrusak', function ($query){
            $query->where('lokasi_id',auth()->user()->roles->first()->id);
        })->latest();
        // Menerapkan filter pada pencarian
        if ($this->search) {
            $produk->where(function ($query) {
                $query->WhereHas('produkrusak.produk', function ($query) {
                    $query->where('nama_barang','like', '%'.$this->search.'%')
                        ->orWhere('keterangan','like', '%'.$this->search.'%')
                        ->orWhere('merk','like', '%'.$this->search.'%')
                        ->orWhere('jumlah','like', '%'.$this->search.'%')
                        ->orWhereHas('kategori',function ($query){
                            $query->where('nama_kategori','like', '%'.$this->search.'%');
                        });
                })->orWhereHas('produkrusak',function ($query){
                    $query->where('jumlah_akhir','like', '%'.$this->search.'%');
                });
            });
        }
        if ($this->status) {
            $produk->where(function ($query) {
                $query->WhereHas('confirmation', function ($query) {
                    $query->where('status', $this->status);
                });
            });
        }
        return view('livewire.user.pengajuan-kerusakan.user-pengajuan-kerusakan-index',[
            'produk' => $produk->paginate(10)
        ]);
    }
}
