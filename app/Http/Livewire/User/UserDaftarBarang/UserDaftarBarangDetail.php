<?php

namespace App\Http\Livewire\User\UserDaftarBarang;

use App\Models\codeproduk;
use Livewire\Component;

class UserDaftarBarangDetail extends Component
{   
    public $produk;
    public function mount($id){
        $this->produk = codeproduk::find($id);
    }
    public function render()
    {
        return view('livewire.user.user-daftar-barang.user-daftar-barang-detail');
    }
}
