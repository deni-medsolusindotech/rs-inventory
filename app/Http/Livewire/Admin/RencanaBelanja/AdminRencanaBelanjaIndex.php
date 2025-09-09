<?php

namespace App\Http\Livewire\Admin\RencanaBelanja;

use App\Models\codeproduk;
use App\Models\kategori;
use App\Models\lokasi;
use App\Models\Produk;
use Livewire\Component;
use Livewire\WithPagination;

class AdminRencanaBelanjaIndex extends Component
{    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search,$kategori_filter,$status;
    public $lokasi,$product ,$category;
  
    public function mount(){
        $this->lokasi = lokasi::all();
        $this->category = kategori::all();
        $this->product = Produk::all();
    }

    public function render()
    {   
        $products = codeproduk::where('status_rencana_belanja', '!=',null)->latest();
        // Menerapkan filter pada pencarian
        if ($this->search) {
            $products->where(function ($query) {
                $query->whereHas('produk', function ($query) {
                    $query->where('nama_barang', 'like', '%'.$this->search.'%')
                          ->orWhere('merk', 'like', '%'.$this->search.'%');
                })->orWhereHas('produk.kategori', function ($query) {
                    $query->where('nama_kategori', 'like', '%'.$this->search.'%');
                })->orWhereHas('lokasi', function ($query) {
                    $query->where('nama_lokasi', 'like', '%'.$this->search.'%');
                })->orWhere('jumlah_awal', 'like', '%'.$this->search.'%');
            });
        }
        if($this->kategori_filter) {
            $products->where(function ($query) {
                $query->WhereHas('produk.kategori', function ($query) {
                    $query->where('id', $this->kategori_filter);
                });
            });
        }
        if($this->status) {
            $products->where(function ($query) {
                $query->where('status_rencana_belanja', $this->status);
            });
        }
        return view('livewire.admin.rencana-belanja.admin-rencana-belanja-index',[
            'produk' => $products->paginate(10)
        ]);
    }
}
