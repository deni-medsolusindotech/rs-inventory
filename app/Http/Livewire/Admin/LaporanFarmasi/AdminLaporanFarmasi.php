<?php

namespace App\Http\Livewire\Admin\LaporanFarmasi;

use App\Models\codeproduk;
use App\Models\kategori;
use App\Models\Produk;
use Livewire\Component;
use Livewire\WithPagination;

class AdminLaporanFarmasi extends Component
{   
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search,$kategori_filter;
    public $lokasi,$product ,$category;
  
    public function mount(){
        $this->category = kategori::all();
        $this->product = Produk::all();
    }

    public function render()
    {   
            $products = codeproduk::whereHas('lokasi', function ($query){
                $query->where('nama_lokasi','farmasi');
            })->latest('updated_at');
            // Menerapkan filter pada pencarian
            if ($this->search) {
                $products->where(function ($query) {
                    $query->whereHas('produk', function ($query) {
                        $query->where('nama_barang', 'like', '%'.$this->search.'%')
                            ->orWhere('merk', 'like', '%'.$this->search.'%');
                    })->orWhereHas('produk.kategori', function ($query) {
                        $query->where('nama_kategori', 'like', '%'.$this->search.'%');
                    })->orWhere('jumlah_awal', 'like', '%'.$this->search.'%')->orWhere('jumlah_akhir', 'like', '%'.$this->search.'%');
                });
            }
            if ($this->kategori_filter) {
                $products->where(function ($query) {
                    $query->WhereHas('produk.kategori', function ($query) {
                        $query->where('id', $this->kategori_filter);
                    });
                });
            }
            return view('livewire.admin.laporan-farmasi.admin-laporan-farmasi',[
                'produk' => $products->paginate(50)
            ]);
    }
}
