<?php

namespace App\Http\Livewire\Admin\RencanaBelanja;

use App\Models\codeproduk;
use App\Models\Distribusi;
use App\Models\log;
use App\Models\lokasi;
use App\Models\Notifikasi;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminRencanaBelanjaDetail extends Component
{   
    use WithFileUploads;
    public $produk,$belanja,$foto,$tgl_kadaluarsa,$cek_kadaluarsa,$cek_distribusi,$codeprodukid;
    public $distribusi = [];
    public $alllokasi,$idproduk;
    protected $rules = [
        'foto' => 'required|image|max:4024',
        'codeprodukid' => 'required'
    ];
    public function mount($id){
        $this->idproduk = $id;
        $this->produk = codeproduk::findOrFail($id);
        $this->alllokasi = lokasi::get();
    }
    public function showbelanja(){
        $this->belanja = true;
    }
    public function removedistribusi($id){
        unset($this->distribusi[$id]);
        $this->distribusi = array_values($this->distribusi);
    }
    public function tambahdistribusi(){
        $this->distribusi[] = [
            'lokasi_id' => '',
            'jumlah' => ''
        ];
    }

    public function updatedDistribusi(){
        if(!count($this->distribusi)){
            $this->cek_distribusi = false;
        }
    }
    public function updatedCekDistribusi(){
        if($this->cek_distribusi){
            $this->tambahdistribusi();
        }else{
            $this->distribusi = [];
        }
    }
    public function sudahbelanja(){
        $this->validate();
        // dd(($this->produk->jumlah_awal -  array_sum(array_column($this->distribusi, 'jumlah'))));
        $this->produk = codeproduk::findOrFail($this->idproduk);
        if($this->cek_kadaluarsa == true){
            $this->tgl_kadaluarsa = null;
        }else{
            $this->validate([
                'tgl_kadaluarsa' => 'required|date',
            ]);
        }
        $this->produk->update([
            'codeprodukid' => $this->codeprodukid,
            'status_rencana_belanja' => 'selesai',
            'tgl_pembelian' => now(),
            'tgl_kadaluarsa' => $this->tgl_kadaluarsa,
        ]);
        $ext = $this->foto->extension();
        $nama_foto = $this->foto->storeAs('/produk','produk-'.$this->produk->id.'.'.$ext,'dokumen');
        $this->produk->produk->update([
            'gambar' => $nama_foto
        ]);
        $usersWithRole = User::whereHas('roles', function ($query) {
            $query->where('id', $this->produk->lokasi_id);
        })->get();
        // distribusikan
        if(count($this->distribusi)){
            foreach ($this->distribusi as $distribusi){
                $produk = [];
                $produk['tgl_pembelian'] = $this->produk->tgl_pembelian;
                $produk['tgl_kadaluarsa'] = $this->produk->tgl_kadaluarsa;
                $produk['status_input_pengadaan'] = $this->produk->status_input_pengadaan;
                $produk['status_rencana_belanja'] = $this->produk->status_rencana_belanja;
                $produk['produk_id'] = $this->produk->produk_id;
                $produk['lokasi_id'] = $distribusi['lokasi_id'];
                $produk['jumlah_awal'] = $distribusi['jumlah'];
                $produk['jumlah_akhir'] = $distribusi['jumlah'];
                $produk['codeprodukid'] = $this->codeprodukid;

                $produkcek = codeproduk::where('produk_id',$this->produk->produk_id)->where('lokasi_id',$distribusi['lokasi_id'])->first();
                if($produkcek){
                    $produkcek->update([
                        'jumlah_akhir' => $produkcek->jumlah_akhir + $distribusi['jumlah']
                    ]);
                }else{
                    codeproduk::create($produk);
                }
                Distribusi::create([
                    'produk_id' => $this->produk->id,
                    'from' => $this->produk->lokasi_id,
                    'to' => $distribusi['lokasi_id'],
                    'jumlah' => $distribusi['jumlah'],
                ]);
            }
            $this->produk->update([
                'jumlah_akhir' => ($this->produk->jumlah_awal -  array_sum(array_column($this->distribusi, 'jumlah'))),
            ]);
        }
        
        foreach($usersWithRole as $user){
            Notifikasi::create([
                'user_id' => $user->id,
                'judul' => 'Rencana Belanja Selesai',
                'pesan' => 'Selamat, rencana belanja sudah selesai oleh '.auth()->user()->name.' silahkan konfirmasi jika barang sudah di lokasi. ',
                'icon' => 'bx bx-cart-alt',
                'color' => 'success',
                'link' => '/daftar-barang/detail/'.$this->produk->id
            ]);
        }
        log::create([
            'user_id' => auth()->user()->id,
            'table'   => 'users',
            'keterangan'=> 'Mengkonfirmasi rencana belanja '.$this->produk->produk->nama_barang .' untuk lokasi '.$this->produk->lokasi->nama_lokasi,
        ]);
        return redirect('rencana-belanja/')->with('success','status data rencana belanja '.$this->produk->produk->nama_barang.' berhasil dikonfirmasi dan diganti sedang dikirim kelokasi');
    }
    public function render()
    {
        return view('livewire.admin.rencana-belanja.admin-rencana-belanja-detail');
    }
}
