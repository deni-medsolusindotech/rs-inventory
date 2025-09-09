<?php

namespace App\Http\Livewire\User\PengajuanKerusakan;

use App\Models\codeproduk;
use App\Models\confirmation;
use App\Models\log;
use App\Models\pengajuankerusakan;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserPengajuanKerusakanTambah extends Component
{   
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $allproduk,$status_produk,$produkpilihan,$bukti;
    public $now,$data = ['nama_barang'];
    public $pengajuan;
    public $rules = [
        'pengajuan.produk' => 'required',
        'pengajuan.bukti' => 'nullable|string',
        'pengajuan.keterangan' => 'required|string',
        'pengajuan.jumlah' => 'required|numeric',
        'pengajuan.author' => 'required',
        'bukti' => 'image|required|max:4024'

    ];

    public function updated($name){
        if($name == 'pengajuan.produk'){
            $this->produkpilihan = codeproduk::find($this->pengajuan->produk)->produk;
        }
    }

    public function buatpengajuan(){
        $this->pengajuan->konfirmasi = 0; 
        $this->validate();
        $konfirmasi = confirmation::create(['status' => 'proses']);
        $this->pengajuan->konfirmasi = $konfirmasi->id; 
        $ext = $this->bukti->extension();
        $gambar_bukti = $this->bukti->storeAs('/bukti','produk-'.$this->pengajuan->id.'.'.$ext,'dokumen');
        $this->pengajuan->bukti = $gambar_bukti;
        $this->pengajuan->save();
        log::create([
            'user_id' => auth()->user()->id,
            'table'   => 'users',
            'keterangan'=> 'Membuat Pengajuan Kerusakan / Kehilangan '.$this->pengajuan->produkrusak->produk->nama_barang.' dari lokasi'. $this->pengajuan->produkrusak->lokasi->nama_lokasi.' sebanyak '.$this->pengajuan->jumlah.' Unit',
        ]);
        return redirect('/pengajuan-kerusakan')->with('success','Barang '.$this->pengajuan->nama_barang.' berhasil di ajukan');
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
        $this->pengajuan = pengajuankerusakan::make();
        $this->pengajuan->author = auth()->user()->id; 
        $this->allproduk = codeproduk::where('lokasi_id',auth()->user()->roles->first()->id)->get();
        $this->now = Carbon::now()->format('d F Y');
        $this->data = ['nama_barang' => 0];
    }

    public function render()
    {   
       
        return view('livewire.user.pengajuan-kerusakan.user-pengajuan-kerusakan-tambah');
    }
}
