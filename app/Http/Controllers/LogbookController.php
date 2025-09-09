<?php

namespace App\Http\Controllers;

use App\Exports\Logbook;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    public function export($bagian,$bulan,$tahun,$id){
            
           return (new Logbook($bagian,$bulan,$tahun,$id))->download('Logbook'.$bagian.$bulan.$tahun.'-'.Carbon::now()->timestamp.'.xlsx');
    }
}
