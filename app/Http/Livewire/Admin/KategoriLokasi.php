<?php

namespace App\Http\Livewire\Admin;

use App\Models\kategori;
use App\Models\log;
use App\Models\lokasi;
use Livewire\Component;

class KategoriLokasi extends Component
{   
    public $lokasi,$pesan;
    public $kategori,$new_kategori;
    protected $rules = [
        'new_kategori' => 'required|unique:kategoris,nama_kategori'
    ];
    public function mount(){
        $this->lokasi = lokasi::get();
        $this->kategori = kategori::latest('id')->get();
    }
    public function updated($name){
        if($name == 'new_kategori'){
            $this->validate();
        }
    }
    public function tambah_kategori(){
        $this->validate();
        kategori::create([
            'nama_kategori' => $this->new_kategori
        ]);
        $this->pesan = "kategori ".$this->new_kategori." berhasil di tambahkan.";
        $this->kategori = kategori::latest('id')->get();
        log::create([
            'user_id' => auth()->user()->id,
            'table'   => 'users',
            'keterangan'=> 'Menambah Kategori '.$this->new_kategori,
        ]);
    }
    public function hapus_kategori($id){
        $kategori = kategori::find($id);
        $this->pesan = "kategori ".$kategori->kategori_id." berhasil di hapus.";
        $kategori->delete();
        $this->kategori = kategori::latest('id')->get();
        log::create([
            'user_id' => auth()->user()->id,
            'table'   => 'users',
            'keterangan'=> 'Menghapus Kategori '.$this->new_kategori,
        ]);
    }
    public function render()
    {
        return view('livewire.admin.kategori-lokasi');
    }
}
