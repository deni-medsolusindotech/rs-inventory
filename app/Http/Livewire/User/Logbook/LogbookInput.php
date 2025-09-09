<?php

namespace App\Http\Livewire\User\LogBook;

use App\Models\Kegiatan;
use App\Models\LogbookPerawat;
use Livewire\Component;

class LogbookInput extends Component
{   
    public $jenis_logbooks,$jenis_kegiatans,$kegiatans ,$jenis_logbook_terakhir;
    public $jenis_logbook,$jenis_kegiatan ;
    public function mount(){
        $this->kegiatans = Kegiatan::get();
        $this->jenis_logbooks = $this->kegiatans->pluck('jenis_logbook')->unique();
        $this->jenis_logbook_terakhir = LogbookPerawat::where('user_id',auth()->user()->id)->latest()->first();
        if($this->jenis_logbook_terakhir) {
            $this->jenis_logbook = $this->jenis_logbook_terakhir->kegiatan->jenis_logbook;
            $this->jenis_logbook_terakhir =  $this->jenis_logbook_terakhir->kegiatan->jenis_logbook;
        }
        $this->jenis_logbook = auth()->user()->status->jenis_logbook;
        $this->jenis_kegiatans = $this->kegiatans;
    }
    public function UpdatedJenisLogbook(){
        $this->emit('setKegiatans',$this->jenis_logbook);
    }
    public function tambah(){
        $this->emit('tambah');
    }
    public function Updated(){
        $this->emit('select');
    }
    public function simpan(){
        $this->emit('simpan');
    }

    public function render()
    {
        return view('livewire.user.logbook.logbook-input');
    }
}
