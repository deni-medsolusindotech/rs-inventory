<?php

namespace App\Http\Livewire\Admin\InputPengadaan;

use App\Models\codeproduk;
use App\Models\kategori;
use App\Models\log;
use App\Models\lokasi;
use App\Models\Produk;
use Livewire\Component;

class AdminInputPengadaanTambah extends Component
{
    public $allkategori, $alllokasi, $nama_lokasi;
    public $produk, $codeproduk;
    public $cari = [], $pilihan;
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
            $cari = Produk::where('nama_barang', 'like', '%' . $this->produk->nama_barang . '%')->with('kategori')->get();
            $this->cari = $cari->toArray();
        }
        $this->validate();
    }

    public function pilih($id)
    {
        $data = [];
        foreach ($this->cari as $cari) {
            if ($cari['id'] == $id) {
                $data = $cari;
            }
        }
        $this->cari = [];
        $this->produk->nama_barang = $data['nama_barang'];
        $this->produk->merk = $data['merk'];
        $this->produk->keterangan = $data['keterangan'];
        $this->produk->kategori_id = $data['kategori_id'];
        $this->pilihan = $data;
    }

    public function save()
    {
        $this->validate();
        if ($this->pilihan) {
            if (
                $this->pilihan['nama_barang'] == $this->produk->nama_barang
                && $this->pilihan['merk'] == $this->produk->merk
                && $this->pilihan['keterangan'] == $this->produk->keterangan
                && $this->pilihan['kategori_id'] == $this->produk->kategori_id
            ) {
                $this->codeproduk->produk_id = $this->pilihan['id'];
            } else {
                $this->produk->save();
                $this->codeproduk->produk_id = $this->produk->id;
            }
        } else {
            $this->produk->save();
            $this->codeproduk->produk_id = $this->produk->id;
        }
        $this->codeproduk->status_rencana_belanja = 'proses';
        $this->codeproduk->status_input_pengadaan = true;
        $this->codeproduk->save();
        log::create([
            'user_id' => auth()->user()->id,
            'table'   => 'users',
            'keterangan' => 'Menambah Produk ' . $this->produk->nama_barang . ' di Input Pengadaan untuk lokasi ' . $this->codeproduk->lokasi->nama_lokasi,
        ]);
        return redirect('/input-pengadaan')->with('success', 'Input Pengadaan Produk ' . $this->produk->nama_barang . ' untuk lokasi ' . $this->nama_lokasi . 'Berhasil disimpan dan masuk ke Data Rencana Belanja');
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
        return view('livewire.admin.input-pengadaan.admin-input-pengadaan-tambah');
    }
}
