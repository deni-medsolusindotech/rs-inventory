<?php

namespace App\Http\Livewire\User\PengajuanKebutuhan;

use App\Models\confirmation;
use App\Models\log;
use App\Models\pengajuankebutuhan;
use App\Models\Produk;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class UserPengajuanKebutuhanTambah extends Component
{   
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $allproduk,$status_produk,$produk_pilihan;
    public $now,$data = ['nama_barang'];
    public $pengajuan;
    public $rules = [
        'pengajuan.nama_barang' => 'required|string',
        'pengajuan.jenis' => 'required|string',
        'pengajuan.jumlah' => 'required|numeric',
        'pengajuan.deskripsi' => 'required|string',
        'pengajuan.lokasi_tujuan' => 'required',
        'pengajuan.konfirmasi' => 'required',
        'pengajuan.author' => 'required',

    ];

    public function buatpengajuan(){
        $this->pengajuan->konfirmasi = 0; 
        $this->validate();
        $konfirmasi = confirmation::create(['status' => 'proses']);
        $this->pengajuan->konfirmasi = $konfirmasi->id; 
        $this->pengajuan->save();
        log::create([
            'user_id' => auth()->user()->id,
            'table'   => 'users',
            'keterangan'=> 'Membuat Pengajuan Kebutuhan '.$this->pengajuan->nama_barang.' untuk lokasi'. $this->pengajuan->lokasi->nama_lokasi,
        ]);
        return redirect('/pengajuan-kebutuhan')->with('succcess','Barang '.$this->pengajuan->nama_barang.' berhasil di ajukan');
    }
    
    public function number($status){
        if(!$this->pengajuan->jumlah){
            $this->pengajuan->jumlah = 0;
        }
        if($status == 'tambah'){
            $this->pengajuan->jumlah += 1;
        }else{
            $this->pengajuan->jumlah -= 1;
        }
    }
    
    public function mount(){
        $this->pengajuan = pengajuankebutuhan::make();
        $this->pengajuan->lokasi_tujuan = auth()->user()->roles->first()->id; 
        $this->pengajuan->author = auth()->user()->id; 
        $this->allproduk = Produk::get();
        $this->now = Carbon::now()->format('d F Y');
        $this->data = ['nama_barang' => 0,'jenis' => 0,'deskripsi' => 0, 'jumlah' => 0];
    }

    public function render()
    {   
       
        return view('livewire.user.pengajuan-kebutuhan.user-pengajuan-kebutuhan-tambah');
    }
}
