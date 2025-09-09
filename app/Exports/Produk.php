<?php

namespace App\Exports;

use App\Models\codeproduk;
use App\Models\LogbookPerawat;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class Produk implements FromView
{
   use Exportable;

   public $lokasi_id;
   public function __construct($lokasi_id = false)
   {
        $this->lokasi_id = $lokasi_id;
   }
    public function view() :View
    {
       
        $produks = codeproduk::where('status_rencana_belanja','selesai')->latest('lokasi_id');
        if($this->lokasi_id != false){
            $produks = $produks->where('lokasi_id',$this->lokasi_id);
        }
        return view('export.opname',[
            'produks' => $produks->get(),
            'lokasi_id' => $this->lokasi_id
        ]);
    }
  
}
