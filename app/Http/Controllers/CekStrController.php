<?php

namespace App\Http\Controllers;

use App\Models\LogbookPerawat;
use Carbon\Carbon;

class CekStrController extends Controller
{
    public function status()
    {
       $createdDate = Carbon::parse(auth()->user()->str->tanggal_kadaluarsa);
       $currentDate = Carbon::now();

       if ($createdDate->diffInDays($currentDate) > 7) {
           return $createdDate->format('d F');
       } else {
           return $createdDate->diffForHumans();
       }
    }
    public function cek(){

        $user = [];$logbook = [];$tanggal_logbook = [];$bukuputih = [];$data = [];
        $bagian = 1;$bulan = [];$tahun = [];$tanggal_mulai = [];$tanggal_akhir = [];

        if(auth()->user()->hasRole('perawat')){
            $user = auth()->user();
        }
        if($bagian == 1){
            $tanggal_mulai = 01;
            $tanggal_akhir = 10;
        }elseif($bagian == 2){
            $tanggal_mulai = 11;
            $tanggal_akhir = 20;
        }elseif($bagian == 3){
            $tanggal_mulai = 21;
            $tanggal_akhir = 31;
        }else{
            $tanggal_mulai = 1;
            $tanggal_akhir = 31;
        }

        $bagian = (!$bagian) ? 1 : $bagian;
        $bulan = (!$bulan) ? str(now()->format('m'))->toInteger() : $bulan;
        $tahun = (!$tahun) ? str(now()->format('Y'))->toInteger() : $tahun;
    
        $date = LogbookPerawat::whereUserId($user->id)->latest()->first()->created_at;

        $awal = str($date->format('Y-m-d'))->replace($date->format('-d'),'-'.$tanggal_mulai).' 00:00:00';
        $akhir = str($date->format('Y-m-d'))->replace($date->format('-d'),'-'.$tanggal_akhir).' 23:00:00';
        
        $awal = str($awal)->replace($date->format('-m-'),'-'.$bulan.'-').' 00:00:00';
        $akhir = str($akhir)->replace($date->format('-m-'),'-'.$bulan.'-').' 23:00:00';
        
        $awal = str($awal)->replace($date->format('Y-'),$tahun.'-').' 00:00:00';
        $akhir = str($akhir)->replace($date->format('Y-'),$tahun.'-').' 23:00:00';
        
        $data =  LogbookPerawat::whereUserId($user->id)->where('created_at','>=',$awal)->where('created_at','<=',$akhir)->orderBy('kegiatan_id')->get();
 
        $data = collect($data);
        $collection = collect($data);
       
        // group 2 dengan hanya kegiatan id 
        $groupedCollection2 = $collection->groupBy(function ($item) { return $item->kegiatan_id; });

        // dapat kan tanggal dari group 2
        foreach($groupedCollection2 as $group){
            if ($group->count() > 1) {
                $group->splice(1);
            }
            foreach ($group as $item){
                $allsame = collect($data->where('kegiatan_id',$item->kegiatan_id));
                $bukuputih[$item->id] = $item;
                $bukuputih[$item->id]->jumlah_kegiatan = $allsame->where('created_at',$item->created_at)->count();
                $bukuputih[$item->id]->total_kegiatan =  $allsame->count();
                $bukuputih[$item->id]->nilai =   $allsame->count() / $item->kegiatan->target * $item->kegiatan->bobot;
                $bukuputih[$item->id]->tanggal = $allsame->pluck('date_day')->toArray();
                $tanggal = collect([]);
                $no = 1;
               
                // setiap data kegiatan id yang sama di beri tanggal , jumlah kegiatan , dan no rm
                foreach($allsame as $same){
                    $tanggal[$no++] = ['tanggal' => $same->created_at->format('d'), 'jumlah_kegiatan' => 1,'no_rm'=> [$same->no_rm]];
                }
                if($item->kegiatan_id == 14){
                    // print($allsame->where('date_day',30)->pluck('no_rm')->toJson());
                    // echo $allsame->date_day;
                }
                // hasil dari atas di loop dan di berikan attribute tangggal jumlah kegiatan dan no rm
                foreach($tanggal as $index => $tgl){
                    $datasama = $tanggal->where('tanggal',$tgl['tanggal']);
                    $jumlah_kegiatan = $datasama->count();
                    // echo $tanggal->toJson()."<br/>";
                    if($jumlah_kegiatan > 1){
                        $tanggal[$index] = ['tanggal' => $tgl['tanggal'], 'jumlah_kegiatan' => $jumlah_kegiatan, 'no_rm' =>  $allsame->where('date_day',$tgl['tanggal'])->pluck('no_rm')->toArray()];
                    }else{
                    }
                }

                // dump($allsame->toArray());
                $bukuputih[$item->id]->tanggal_dan_jumlah_kegiatan =  $tanggal->unique('tanggal')->toArray();
                $bukuputih = collect($bukuputih);
           };
        };



        return view('export.logbook',[
            'data' => $data,
            'bukuputih' => $bukuputih,
            'tanggal_akhir' => $tanggal_akhir,
            'tanggal_mulai' => $tanggal_mulai,
            'bagian' => $bagian,
            'user' => $user,
            'bulan' => 'agustus',
            'tahun' => '2023',
        ]);
    }
}
