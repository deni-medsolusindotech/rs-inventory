<?php

namespace App\Http\Livewire\Admin\AdminPengajuanKerusakan;

use App\Models\log;
use App\Models\Notifikasi;
use App\Models\pengajuankerusakan;
use Livewire\Component;

class AdminPengajuanKerusakanDetail extends Component
{   
    public $pengajuan;
    public $allkategori;
    public function mount($id){
        $this->pengajuan = pengajuankerusakan::findOrFail($id);
    }
  
    public function terima(){
        $jumlah_akhir = $this->pengajuan->produkrusak->jumlah_akhir - $this->pengajuan->jumlah;
        $this->pengajuan->produkrusak->update([
            'jumlah_akhir' => $jumlah_akhir,
        ]);
        $this->pengajuan->confirmation->update([
            'status' => 'terima',
            'alasan' => null,
            'by' => auth()->user()->id
        ]);
        Notifikasi::create([
            'user_id' => $this->pengajuan->by->id,
            'judul' => 'Konfirmasi Pengajuan kerusakan Di Terima',
            'pesan' => 'Selamat, konfirmasi pengajuan kerusakan anda di terima oleh '.auth()->user()->name .'. Produk '.$this->pengajuan->produkrusak->produk->nama_barang.
                        ' dengan stok '.$this->pengajuan->produkrusak->jumlah_akhir.' unit di kurangi / dihapus '.$this->pengajuan->jumlah.' unit',
            'icon' => 'bx bx-receipt',
            'color' => 'success',
            'link' => '/pengajuan-kerusakan'
        ]);
        log::create([
            'user_id' => auth()->user()->id,
            'table'   => 'users',
            'keterangan'=> 'Menerima pengajuan kerusakan '.$this->pengajuan->produkrusak->nama_barang.' dari user '.$this->pengajuan->by->name.'dengan jumlah hilang/rusak '.$this->pengajuan->jumlah.'unit di lokasi '.$this->pengajuan->produkrusak->lokasi->nama_lokasi,
        ]);
        return redirect('/aproval-rusak')->with('success','Konfirmasi pengajuan kerusakan / hilang '.$this->pengajuan->by->name.' berhasil di terima');
    }
    public function tolak($alasan){
        $this->pengajuan->confirmation->update([
            'status' => 'tolak',
            'alasan' => $alasan,
            'by' => auth()->user()->id
        ]);
        Notifikasi::create([
            'user_id' => $this->pengajuan->by->id,
            'judul' => 'Konfirmasi Pengajuan kerusakan Di Tolak',
            'pesan' => 'Mohon Maaf, konfirmasi pengajuan kerusakan anda di tolak oleh '.auth()->user()->name .'.Dengan alasan ' .$alasan,
            'icon' => 'bx bx-receipt',
            'color' => 'danger',
            'link' => '/pengajuan-kerusakan'
        ]);
        log::create([
            'user_id' => auth()->user()->id,
            'table'   => 'users',
            'keterangan'=> 'Menolak pengajuan kerusakan '.$this->pengajuan->produkrusak->nama_barang.' dari user '.$this->pengajuan->by->name.'dengan jumlah hilang/rusak '.$this->pengajuan->jumlah.'unit di lokasi '.$this->pengajuan->produkrusak->lokasi->nama_lokasi,
        ]);
        return redirect('/aproval-rusak')->with('success','Konfirmasi pengajuan kerusakan '.$this->pengajuan->by->name.' berhasil di tolak');
    }
    public function render()
    {
        return view('livewire.admin.admin-pengajuan-kerusakan.admin-pengajuan-kerusakan-detail');
    }
}
