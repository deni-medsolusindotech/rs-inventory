<?php

namespace App\Http\Livewire\Admin\LaporanFarmasi;

use App\Models\codeproduk;
use App\Models\confirmation;
use App\Models\farmasi;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class AdminLaporanFarmasiPengeluaran extends Component
{   use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search,$maxproduk,$pesan,$pengeluaran_seminggu_terakhir;
    protected $queryString = ['pengeluaran_seminggu_terakhir' => ['except' => '']];
    public $lokasi,$produk ,$farmasi,$date_filter;

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

    public function updated($name){
        $this->pesan = null;
    }


    public function mount(){
        $this->produk =  codeproduk::whereHas('lokasi', function ($query){
            $query->where('nama_lokasi','farmasi');
        })->where('status_rencana_belanja','!=','proses')->where('jumlah_akhir','>',0)->latest()->get();
    }

    public function render()
    {       
            
            $stok = farmasi::whereHas('codeproduk.lokasi', function ($query){
                $query->where('nama_lokasi', 'farmasi');
            })->latest();
            // Menerapkan filter pada pencarian
            if ($this->search) {
                $stok->where(function ($query) {
                    $query->WhereHas('codeproduk', function ($query) {
                        $query->where('jumlah_awal', 'like', '%'.$this->search.'%')
                              ->orWhere('jumlah_akhir', 'like', '%'.$this->search.'%');
                    })->orwhereHas('codeproduk.produk', function ($query) {
                        $query->where('nama_barang', 'like', '%'.$this->search.'%')
                            ->orWhere('merk', 'like', '%'.$this->search.'%');
                    })->orWhereHas('codeproduk.produk.kategori', function ($query) {
                        $query->where('nama_kategori', 'like', '%'.$this->search.'%');
                    })->orWhereHas('by', function ($query) {
                        $query->where('name', 'like', '%'.$this->search.'%')
                              ->where('email', 'like', '%'.$this->search.'%')
                              ->where('nomor_hp', 'like', '%'.$this->search.'%');
                
                    })->orWhere('jumlah', 'like', '%'.$this->search.'%');
                });
            }

            if($this->pengeluaran_seminggu_terakhir){
                $seminggu_terakhir = Carbon::now()->subWeek(); // Mengambil tanggal sebulan yang lalu
                $stok->whereDate('created_at', '>=', $seminggu_terakhir);
            }

            if($this->date_filter){
                $stok->whereDate('created_at','like', '%'.$this->date_filter.'%');
            }

            return view('livewire.admin.laporan-farmasi.admin-laporan-farmasi-pengeluaran',[
                'stok' => $stok->paginate(10)
            ]);
    }
}
