<?php

namespace App\Http\Livewire\User\Farmasi;

use App\Models\codeproduk;
use App\Models\confirmation;
use App\Models\farmasi;
use Livewire\Component;
use Livewire\WithPagination;

class UserFarmasiStokTambah extends Component
{   
     use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search,$maxproduk,$pesan,$produk_tambah;
    public $lokasi,$produk ,$farmasi;
    public $rules = [
        'farmasi.produk' => 'required|numeric',
        'farmasi.jumlah' => 'required|numeric'
    ];

    public function batal($id){
        $farmasi = farmasi::find($id);
        $this->pesan = 'Produk pengeluaran '.$farmasi->codeproduk->produk->nama_barang .' , produk dikurangi '.$farmasi->jumlah .' Unit, Berhasil Dibatalkan';  
        $jumlah_akhir = $farmasi->codeproduk->jumlah_akhir + $farmasi->jumlah;
        $farmasi->codeproduk->update([
            'jumlah_akhir' => $jumlah_akhir,
        ]);
        $farmasi->delete();
        $this->render();
    }

    public function save(){
        $this->validate();
        $confirm = confirmation::create([
            'status' => 'proses'
        ]);
        $this->farmasi->konfirmasi = $confirm->id;
        $this->farmasi->author     = auth()->user()->id;
        $this->farmasi->save();
        $jumlah_akhir = $this->produk_tambah->jumlah_akhir - $this->farmasi->jumlah;
        $this->produk_tambah->update([
            'jumlah_akhir' => $jumlah_akhir,
        ]);
        $this->pesan = 'Produk pengeluaran '.$this->produk_tambah->produk->nama_barang .' berhasil , produk dikurangi '.$this->farmasi->jumlah .' Unit'; 
        $this->mount(); 
        $this->render();
    }

    public function updated($name){
        $this->pesan = null;
        if($name == 'farmasi.jumlah'){
            $this->validateOnly('farmasi.jumlah');
        }
        if($name == 'farmasi.produk'){
            $produk = codeproduk::find($this->farmasi->produk);
            $this->produk_tambah = $produk;
            $this->rules['farmasi.jumlah'] = 'required|numeric|max:'.$produk->jumlah_akhir;
        }
    }
    public function number($status){
        if($status == 'tambah'){
            $this->farmasi->jumlah += 1;
        }else{
            $this->farmasi->jumlah += 1;
        }
    }

    public function mount(){
        $this->farmasi = farmasi::make();
    }

    public function render()
    {       
            $this->produk =  codeproduk::where('lokasi_id', auth()->user()->roles->first()->id)
            ->where('status_rencana_belanja','!=','proses')->where('jumlah_akhir','>',0)->latest()->get();
            $stok = farmasi::whereHas('codeproduk',function ($query){
                $query->where('lokasi_id', auth()->user()->roles->first()->id)->where('status_rencana_belanja','!=','proses');
            })->latest();
            // Menerapkan filter pada pencarian
            if ($this->search) {
                $stok->where(function ($query) {
                    $query->whereHas('codeproduk.produk', function ($query) {
                        $query->where('nama_barang', 'like', '%'.$this->search.'%')
                            ->orWhere('merk', 'like', '%'.$this->search.'%');
                    })->orWhereHas('codeproduk.produk.kategori', function ($query) {
                        $query->where('nama_kategori', 'like', '%'.$this->search.'%');
                    })->orWhereHas('codeproduk', function ($query) {
                        $query->where('jumlah_awal', 'like', '%'.$this->search.'%')
                            ->orWhere('jumlah_akhir', 'like', '%'.$this->search.'%');
                    })->orWhere('jumlah','like', '%'.$this->search.'%');
                });
            }
            return view('livewire.user.farmasi.user-farmasi-stok-tambah',[
                'stok' => $stok->paginate(10)
            ]);
    }
}