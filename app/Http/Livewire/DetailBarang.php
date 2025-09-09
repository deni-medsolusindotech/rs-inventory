<?php

namespace App\Http\Livewire;

use App\Models\codeproduk;
use Livewire\Component;

class DetailBarang extends Component
{   
    public $produk;
    public function mount($id){
        $this->produk = codeproduk::find($id);
    }
    public function render()
    {
        return view('livewire.detail-barang')->layout('layouts.app2');
    }
}
