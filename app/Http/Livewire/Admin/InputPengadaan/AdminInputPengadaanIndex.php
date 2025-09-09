<?php

namespace App\Http\Livewire\Admin\InputPengadaan;

use App\Models\codeproduk;
use Livewire\Component;
use Livewire\WithPagination;

class AdminInputPengadaanIndex extends Component
{   
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search,$status;
    public $jumlah;
  
  

    public function render()
    {   
        $products = codeproduk::where('status_input_pengadaan','!=',null)->latest();
        // Menerapkan filter pada pencarian
      
        if ($this->search) {
            $products->where(function ($query) {
                $query->whereHas('produk',function ($query){
                    $query->where('nama_barang','like', '%'.$this->search.'%')
                        ->orWhere('merk','like', '%'.$this->search.'%');
                })->orWhere('jumlah_awal','like', '%'.$this->search.'%')
                ->orWhereHas('lokasi',function ($query){ 
                    $query->where('nama_lokasi','like', '%'.$this->search.'%'); 
                });
            });
        }
        if ($this->status) {
            $products->where('status_rencana_belanja',$this->status);
        }
        return view('livewire.admin.input-pengadaan.admin-input-pengadaan-index',[
            'produk' => $products->paginate(10)
        ]);
    }
}
