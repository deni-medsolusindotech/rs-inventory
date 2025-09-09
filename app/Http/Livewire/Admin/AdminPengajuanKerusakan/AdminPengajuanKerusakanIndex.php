<?php

namespace App\Http\Livewire\Admin\AdminPengajuanKerusakan;

use App\Models\pengajuankerusakan;
use Livewire\Component;
use Livewire\WithPagination;

class AdminPengajuanKerusakanIndex extends Component
{   
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search,$status;
   

    public function render()
    {   
        $pengajuan = pengajuankerusakan::latest();
      
        if ($this->search) {
            $pengajuan->where(function ($query) {
                $query->WhereHas('produkrusak.produk', function ($query) {
                    $query->where('nama_barang','like', '%'.$this->search.'%')
                        ->orWhere('keterangan','like', '%'.$this->search.'%')
                        ->orWhere('merk','like', '%'.$this->search.'%')
                        ->orWhere('jumlah','like', '%'.$this->search.'%');
                })->orWhereHas('produkrusak',function ($query){
                    $query->where('jumlah_akhir','like', '%'.$this->search.'%');
                })->orWhereHas('produkrusak.produk.kategori',function ($query){
                    $query->where('nama_kategori','like', '%'.$this->search.'%');
                })->orWhereHas('produkrusak.lokasi',function ($query){
                    $query->where('nama_lokasi','like', '%'.$this->search.'%');
                })->orWhereHas('by',function ($query){
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
        return view('livewire.admin.admin-pengajuan-kerusakan.admin-pengajuan-kerusakan-index',[
            'pengajuan' => $pengajuan->paginate()
        ]);
    }
}
