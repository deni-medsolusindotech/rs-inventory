<?php

namespace App\Http\Controllers;

use App\Exports\Produk;
use App\Models\codeproduk;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    // public function stokopname(){
    //     return view('export.opname',[
    //         'produks' => codeproduk::latest()->get()
    //     ]);
    // }
    public function stokopname(){
        $lokasi_id = request('lokasi_id') ?? false;
        return (new Produk($lokasi_id))->download('RSUD-Malangbong-List-Produk.xlsx');
    }
}
