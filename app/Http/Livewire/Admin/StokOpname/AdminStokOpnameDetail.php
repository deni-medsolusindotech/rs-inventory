<?php

namespace App\Http\Livewire\Admin\StokOpname;

use App\Models\codeproduk;
use Livewire\Component;

class AdminStokOpnameDetail extends Component
{   
    public $produk;
    public function mount($id){
        $this->produk = codeproduk::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.admin.stok-opname.admin-stok-opname-detail');
    }
}
