<?php

namespace App\Http\Livewire;

use App\Models\codeproduk;
use Livewire\Component;

class PrintQrBarang extends Component
{   
    public $produk,$ukuran,$jumlah;
    public $queryString = ['ukuran'];
    public function mount($id){
        $this->ukuran = 150;
        $this->jumlah = 1;
        $this->produk = codeproduk::findOrFail($id);
    }
    public function updating(){
        $this->jumlah = 1;
    }
    public function print(){
        if($this->ukuran == 100){
            $this->jumlah = 7;
        }
        if($this->ukuran == 150){
            $this->jumlah = 5;
        }
        if($this->ukuran == 200){
            $this->jumlah = 4;
        }
    }
    public function render()
    {
        return view('livewire.print-qr-barang');
    }
}
