<?php

namespace App\Http\Livewire\SuperAdmin;
use App\Models\codeproduk;
use App\Models\kategori;
use App\Models\log;
use App\Models\lokasi;
use App\Models\Produk;
use Livewire\Component;
class HardcoreEdit extends Component
{   
    public $allkategori, $alllokasi, $nama_lokasi;
    public $produk, $codeproduk;
    public $cari = [], $pilihan = false;
    protected $rules = [
        'produk.nama_barang' => 'required|string',
        'produk.merk' => 'required|string',
        'produk.kategori_id' => 'required|numeric',
        'produk.keterangan' => 'required|string',
        'codeproduk.lokasi_id' => 'required|numeric',
        'codeproduk.jumlah_awal' => 'required|numeric',
        'codeproduk.tgl_pembelian' => 'required|date',
    ];

    public function updated($name)
    {
        if ($name == 'produk.nama_barang') {
            $cari = codeproduk::where(function ($query) {
                $query->whereHas('produk', function ($query) {
                    $query->where('nama_barang', 'like', '%' . $this->produk->nama_barang . '%')
                        ->orWhere('merk','like', '%' . $this->produk->nama_barang . '%');
                });
            })->orWhere('codeprodukid', 'like', '%' . $this->produk->nama_barang . '%')->with(['produk','lokasi'])->get();
            $this->cari = $cari->toArray();
        }
        $this->validate();
    }

    public function pilih($id)
    {   
        $this->codeproduk = codeproduk::find($id);
        $this->produk = $this->codeproduk->produk;
        $data = [];
        foreach ($this->cari as $cari) {
            if ($cari['id'] == $id) {
                $data = $cari;
            }
        }
        $this->cari = [];
        $this->pilihan = $data;
    }

    public function save()
    {
        $this->validate();
        $this->codeproduk->save();
        $this->produk->save();
        log::create([
            'user_id' => auth()->user()->id,
            'table'   => 'users',
            'keterangan' => 'EDIT HARDCORE PRODUK ' . $this->produk->nama_barang . ' LOKASI ' . $this->codeproduk->lokasi->nama_lokasi,
        ]);
        return redirect('/edit-data-hardcore')->with('success', 'EDIT HARDCORE ' . $this->produk->nama_barang . ' untuk lokasi ' . $this->nama_lokasi . 'Berhasil disimpan ( * setiap perubahan di rekam di riwayat )');
    }
    public function mount()
    {
        $this->codeproduk = codeproduk::make();
        $this->produk = Produk::make();
        $this->allkategori = kategori::get();
        $this->alllokasi = lokasi::get();
        $this->codeproduk->tgl_pembelian = now();
    }

    public function render() 
    {
        return view('livewire.super-admin.hardcore-edit');
    }
}
