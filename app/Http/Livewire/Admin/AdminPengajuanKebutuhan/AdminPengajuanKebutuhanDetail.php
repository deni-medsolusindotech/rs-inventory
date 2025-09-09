<?php

namespace App\Http\Livewire\Admin\AdminPengajuanKebutuhan;

use App\Models\codeproduk;
use App\Models\kategori;
use App\Models\log;
use App\Models\Notifikasi;
use App\Models\pengajuankebutuhan;
use App\Models\Produk;
use Livewire\Component;

class AdminPengajuanKebutuhanDetail extends Component
{   
    public $pengajuan,$belanja,$showbelanja,$codeproduk,$produk;
    public $allkategori;
    public $rules = [
        'produk.nama_barang' => 'required',
        'produk.kategori_id' => 'required',
        'produk.merk' => 'required',
        'produk.keterangan' => 'required',
        'codeproduk.tgl_pembelian' => 'required',
        'codeproduk.jumlah_awal' => 'required',
        'codeproduk.produk_id' => 'nullable',
        'codeproduk.lokasi_id' => 'nullable',
        'codeproduk.status_rencana_belanja' => 'nullable'
    ];
    public function mount($id){
        $this->pengajuan = pengajuankebutuhan::find($id);
        $this->allkategori = kategori::get();
        if($this->pengajuan->status == 'terima'){
            $this->showbelanja = true;
            $this->codeproduk = $this->pengajuan->produk;
            $this->produk = $this->pengajuan->produk->produk;
        }
    }
    public function showbelanja($status = true){
        if($status){
            $this->codeproduk = codeproduk::make();
            $this->produk = Produk::make();
            $this->produk->nama_barang = $this->pengajuan->nama_barang;
            $this->codeproduk->jumlah_awal = intval($this->pengajuan->jumlah);
            $this->showbelanja = true;
            $this->validate();
        }else{
            $this->showbelanja = false;
        }
    }

    public function updated($name){
        if($this->pengajuan->status == 'terima' && $name == 'belanja'){
            $this->belanja = 0;
        }
        $this->validate();
    }
    public function terima(){
        $this->validate();
        $this->produk->save();
        $this->codeproduk->produk_id = $this->produk->id;
        $this->codeproduk->lokasi_id = $this->pengajuan->lokasi_tujuan;
        $this->codeproduk->status_rencana_belanja = 'proses';
        $this->codeproduk->save();
        $this->pengajuan->update([
            'produk_baru' => $this->codeproduk->id
        ]);
        $this->pengajuan->confirmation->update([
            'status' => 'terima',
            'alasan' => null,
            'by' => auth()->user()->id
        ]);
        Notifikasi::create([
            'user_id' => $this->pengajuan->by->id,
            'judul' => 'Konfirmasi Pengajuan Kebutuhan Di Terima',
            'pesan' => 'Selamat, konfirmasi pengajuan kebutuhan anda di terima oleh '.auth()->user()->name .'. Produk Masuk Ke daftar rencana belanja.',
            'icon' => 'bx bx-download',
            'color' => 'success',
            'link' => '/pengajuan-kebutuhan'
        ]);
        log::create([
            'user_id' => auth()->user()->id,
            'table'   => 'users',
            'keterangan'=> 'Menerima pengajuan kebutuhan '.$this->pengajuan->nama_barang.' dari user '.$this->pengajuan->by->name.' untuk lokasi '.$this->pengajuan->lokasi->nama_lokasi,
        ]);
        return redirect('/aproval-pengajuan')->with('success','Konfirmasi pengajuan kebutuhan '.$this->pengajuan->by->name.' berhasil di tolak');
    }
    public function tolak($alasan){
        $this->pengajuan->confirmation->update([
            'status' => 'tolak',
            'alasan' => $alasan,
            'by' => auth()->user()->id
        ]);
        Notifikasi::create([
            'user_id' => $this->pengajuan->by->id,
            'judul' => 'Konfirmasi Pengajuan Kebutuhan Di Tolak',
            'pesan' => 'Mohon Maaf, konfirmasi pengajuan kebutuhan anda di tolak oleh '.auth()->user()->name .'.Dengan alasan ' .$alasan,
            'icon' => 'bx bx-download',
            'color' => 'danger',
            'link' => '/pengajuan-kebutuhan'
        ]);
        log::create([
            'user_id' => auth()->user()->id,
            'table'   => 'users',
            'keterangan'=> 'Menolak pengajuan kebutuhan '.$this->pengajuan->nama_barang.' dari user '.$this->pengajuan->by->name.' untuk lokasi '.$this->pengajuan->lokasi->nama_lokasi,
        ]);
        return redirect('/aproval-pengajuan')->with('success','Konfirmasi pengajuan kebutuhan '.$this->pengajuan->by->name.' berhasil di tolak');
    }
    public function render()
    {
        return view('livewire.admin.admin-pengajuan-kebutuhan.admin-pengajuan-kebutuhan-detail');
    }
}
