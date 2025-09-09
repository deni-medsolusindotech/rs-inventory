<?php

namespace App\Http\Livewire\User;

use App\Models\codeproduk;
use App\Models\kategori;
use App\Models\lokasi;
use App\Models\Produk;
use Livewire\Component;
use Livewire\WithPagination;

class UserDaftarBarang extends Component
{   
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search,$kategori_filter;
    public $lokasi,$product ,$category;
  
    public function mount(){
        $this->lokasi = lokasi::all();
        $this->category = kategori::all();
        $this->product = Produk::all();
    }

    public function render()
    {   
        $products = codeproduk::where('lokasi_id', auth()->user()->roles->first()->id)->latest();
        // Menerapkan filter pada pencarian
        if ($this->search) {
            $products->where(function ($query) {
                $query->whereHas('produk', function ($query) {
                    $query->where('nama_barang', 'like', '%'.$this->search.'%')
                          ->orWhere('keterangan', 'like', '%'.$this->search.'%')
                          ->orWhere('merk', 'like', '%'.$this->search.'%');
                })->orWhereHas('produk.kategori', function ($query) {
                    $query->where('nama_kategori', 'like', '%'.$this->search.'%');
                });
            });
        }
        if ($this->kategori_filter) {
            $products->where(function ($query) {
                $query->WhereHas('produk.kategori', function ($query) {
                    $query->where('id', $this->kategori_filter);
                });
            });
        }
        return view('livewire.user.user-daftar-barang',[
            'produk' => $products->paginate(10)
        ]);
    }
  
}
