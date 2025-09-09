<?php

namespace App\Http\Livewire;

use App\Models\filesementara;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadDokumen extends Component
{   
    use WithFileUploads;
    public $ext,$dokumen,$temp,$namafile,$folder,$file;
    public $listeners = ['save'];

    public function mount($nama,$file)
    {
        $this->namafile = $nama.auth()->user()->id;
        $this->file = $file;
        $this->folder = $nama;
    }

    public function UpdatedDokumen(){
        $this->validate(['dokumen' => 'required|mimes:pdf,jpeg,png,gif,jpg|max:2048']);
        $this->ext = $this->dokumen->extension();
        $this->hapus();
        $this->file = $this->dokumen->storeAs($this->folder,$this->namafile.'.'.$this->ext,'dokumen');
        // $data = filesementara::create(['user_id' => auth()->user()->id,'nama_file' => $this->file]);
        $this->emit('dokumen',$this->file);
        $this->emit('show',$this->file);
    }

    public function hapus(){
        $fileName = $this->namafile; // Nama file yang ingin dicek
        $directory = $this->folder; // Direktori tempat file disimpan di dalam disk 'dokumen'

        // Mendapatkan semua file dalam direktori
        $files = Storage::disk('dokumen')->files($directory);

        foreach ($files as $file) {
            // Mengekstrak nama file dan ekstensi
            $pathinfo = pathinfo($file);
            $file_name = $pathinfo['filename'];

            // Memeriksa jika nama file sama
            if ($file_name === $fileName) {
                // Menghapus file
                Storage::disk('dokumen')->delete($file);
            }
        }
    }
    public function render(){
        return view('components.upload-dokumen');
    }
}
