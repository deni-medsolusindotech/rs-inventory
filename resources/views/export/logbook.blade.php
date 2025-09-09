<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .data-container {
    display: flex;
    flex-direction: column;
    border: 1px solid #ddd;
    padding: 20px;
}

.data-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    padding: 5px;
    border-bottom: 1px solid #ddd;
}

.label {
    font-weight: bold;
    width: 150px;
}

.value {
    flex-grow: 1;
    text-align: right;
}

    </style>
</head>
<body>
    <div class="row">
        <div class="col-lg-12">
            <div class="card rtc shadow-lg" style="min-height: 400px;">
                {{-- @dump($bukuputih) --}}
                <div class="card-body">
                    <table style="width:600px;text-align:center;">
                        <tr>
                            <td  colspan="{{ $tanggal_akhir - $tanggal_mulai + 7 }}" style="width:100%;text-align:center; " >
                                <h2 style=" font-size: 20px">Logbook Kegiatan Perawat</h2>

                            </td>
                        </tr>
                    </table>

                    <table style="width:100%; margin-bottom:500px;">
                        <tr><td colspan="2"  style="width:400px;">NAMA </td><td colspan="3"> : {{ str($user->ktp->nama)->headline() }}</td></tr>
                        <tr><td colspan="2"  style="width:400px;">PANGKAT GOLONGAN</td><td colspan="3"> : {{ str($user->status->pangkat->pangkat)->headline() }}</td></tr>
                        <tr><td colspan="2"  style="width:400px;">PANGKAT GOLONGAN</td><td colspan="3"> : {{ str($user->status->pangkat->pangkat)->headline() }}</td></tr>
                        <tr><td colspan="2" style="width:400px;">NIP</td> <td colspan="3"> : {{ ($user->status->nip) ?? '-' }}</td> </tr>
                        <tr><td colspan="2" style="width:400px;">JENJANG JABATAN</td> <td colspan="3"> : {{ str($user->kewenangan->pk)->headline() }}</td> </tr>
                        <tr><td colspan="2" style="width:400px;">BULAN</td> <td colspan="3"> : {{ str($bulan)->headline() }} {{ $tahun }}</td> </tr>
                    </table>
                    
                    




 

                    <div class="table-responsive">
                        @if ($bagian != 'rekap')
                            <table  id="" class="table table-sm table-bordered w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" rowspan="3" style="width:50px;text-align:center; " class="text-center">NO</th>
                                        <th scope="col" rowspan="3" class="text-center " style="text-align:center;width:300px; border: 1px solid #000;">NAMA KEGIATAN</th>
                                        <th scope="col" rowspan="3" class="text-center " style="text-align:center; border: 1px solid #000;">TARGET</th>
                                        <th scope="col" rowspan="3" class="text-center " style="text-align:center; border: 1px solid #000;">BOBOT</th>
                                        <th scope="col" style="text-align:center;width:300px; border: 1px solid #000;" colspan="{{ $tanggal_akhir - $tanggal_mulai + 1 }} " class="text-center my-auto">TANGGAL</th>
                                        <th scope="col" rowspan="3" class="text-center " style="text-align:center; border: 1px solid #000;width:100px;">TOTAL <br> KEGIATAN</th>
                                        <th scope="col" rowspan="3" class="text-center " style="text-align:center; border: 1px solid #000;">NILAI</th>
                                    </tr>
                                    <tr class="table-info">        
                                        @php
                                            for($i = $tanggal_mulai;$i <= $tanggal_akhir;$i++){
                                                echo "<th style='text-align:center; border: 1px solid #000;width:100px'> $i </th>";
                                                // echo "<th> NO RM </th>";   
                                            }
                                        @endphp
                                    </tr>
                                    <tr>
                                        @for($i =$tanggal_mulai;$i <= $tanggal_akhir;$i++)
                                            <th style="text-align:center; border: 1px solid #000;width:100px"> NO RM </th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @forelse ($bukuputih as  $index => $log)
                                    <tr > 
                                        <td style="text-align:center;width:50px; border: 1px solid #000;" rowspan="2">
                                        {{$no++}}
                                        </td>
                                        <td style=" word-wrap: break-word;"><p class="mb-0 ">{{ $log->kegiatan->isi }} </p> </td>
                                        <td style='text-align:center; border: 1px solid #000;'>{{ $log->kegiatan->target }}</td>
                                        <td style='text-align:center; border: 1px solid #000;'>{{ $log->kegiatan->bobot }}</td>
                                        @php
                                            $e = 0;
                                            for($i = $tanggal_mulai;$i <= $tanggal_akhir;$i++){
                                                $e = $i % 2;
                                                $data = "";
                                                $color = ($e) ? 'primary' : 'info';
                                                foreach($log->tanggal_dan_jumlah_kegiatan as $tgl_dan_jml){
                                                    if($tgl_dan_jml['tanggal'] == $i){
                                                        $data = $tgl_dan_jml['no_rm'];
                                                    }
                                                }
                                                if($data){
                                                    echo "<td style='text-align:center;border: 1px solid #000;' class='table-".$color."'>";
                                                    foreach($data as $item){
                                                        echo $item ."<br/>";
                                                        }
                                                    echo "</td>";
                                                    }else{
                                                        echo "<td style='text-align:center;border: 1px solid #000;' class='table-".$color."'> $data </td>";
                                                }
                                            }
                                        @endphp
                                        <td style="text-align:center;border: 1px solid #000;" class="text-center">
                                            {{ $log->total_kegiatan }}
                                        </td>
                                        <td style="text-align:center;border: 1px solid #000;">
                                            {{ $log->nilai }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style=" border: 1px solid #000;background-color:yellow;" class="table-warning">Jumlah</td>
                                        @php
                                        $e = 0;
                                        for($i = $tanggal_mulai;$i <= $tanggal_akhir;$i++){
                                            $e = $i % 2;
                                            $data = "";
                                            $color = ($e) ? 'warning' : 'warning';
                                            foreach($log->tanggal_dan_jumlah_kegiatan as $tgl_dan_jml){
                                            if($tgl_dan_jml['tanggal'] == $i){
                                                $data = count($tgl_dan_jml['no_rm']);
                                            }
                                            }
                                            if($data){
                                                echo "<td style='text-align:center;border: 1px solid #000;background-color:yellow;' class='table-".$color."'>$data </td>";
                                            }else{
                                                echo "<td style='text-align:center;border: 1px solid #000;background-color:yellow;' class='table-".$color."'> $data </td>";
                                        }
                                        }
                                    @endphp
                                
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <h3 class="p-5 m-5">
                                                Tidak Ada Logbook...
                                            </h3>
                                        </td>
                                    </tr>
                                    @endforelse
                                <tr>
                                    <td style='text-align:center;border: 1px solid #000;'></td>
                                    <td style='text-align:center; border: 1px solid #000;' colspan="{{ $tanggal_akhir - $tanggal_mulai + 5 }} " class="text-center table-warning">Jumlah Kumulatif Nilai {{ $bagian }}</td>
                                    <td style='text-align:center;border: 1px solid #000;' colspan="1"class="table-primary">{{ $bukuputih->sum('nilai') }}</td>
                                </tr>
                                </tbody>
                            </table>
                        @endif
                        @if ($bagian == 'rekap' || $bagian == 'semua')
                        <table  id="" class="table table-sm table-bordered w-100">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" rowspan="2" style="text-align:center;width:50px; border: 1px solid #000;"class="text-center"> <b> No</b></th>
                                    <th scope="col" rowspan="2" class="text-center " style="text-align:center;width:300px; border: 1px solid #000;"><b> Nama Kegiatan</b></th>
                                    <th scope="col" rowspan="2" class="text-center " style="text-align:center;width:100px; border: 1px solid #000;"><b> Target</b></th>
                                    <th scope="col" rowspan="2" class="text-center " style="text-align:center;width:100px; border: 1px solid #000;"><b> Bobot</b></th>
                                    <th scope="col" colspan="3" class="text-center my-auto" style="text-align:center;width:300px; border: 1px solid #000;"><b> Kumulatif Nilai</b></th>
                                    <th scope="col" rowspan="2" class="text-center " style="text-align:center;width:100px; border: 1px solid #000;" ><b>Total Kegiatan</b> </th>
                                    <th scope="col" rowspan="2" class="text-center "style="text-align:center;width:100px; border: 1px solid #000;"><b> Nilai</b></th>
                                </tr>
                                <tr class="table-info">   
                                    <th style="text-align:center;width:100px; border: 1px solid #000;"><b> 1</b></th>     
                                    <th style="text-align:center;width:100px; border: 1px solid #000;"><b> 2</b></th>     
                                    <th style="text-align:center;width:100px; border: 1px solid #000;"><b> 3</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($bukuputih as  $index => $log)
                                 <tr > 
                                     <td style="text-align:center;border: 1px solid #000;width:50px;">
                                     {{$no++}}
                                     </td>
                                     <td style="text-align:center;border: 1px solid #000;word-wrap: break-word;"><p class="mb-0 ">{{ $log->kegiatan->isi }} </p> </td>
                                     <td style="text-align:center;border: 1px solid #000;">{{ $log->kegiatan->target }}</td>
                                     <td style="text-align:center;border: 1px solid #000;">{{ $log->kegiatan->bobot }}</td>
                                     @php
                                        $data = [];
                                         for($i = 1;$i <= 10;$i++){
                                             foreach($log->tanggal_dan_jumlah_kegiatan as $tgl_dan_jml){
                                                if($tgl_dan_jml['tanggal'] == $i){
                                                    $data = $tgl_dan_jml['no_rm'];
                                                }
                                             }
                                            }
                                        echo "<td style='text-align:center;border: 1px solid #000;' class='table-primary'>". count($data) ."</td>";
                                         
                                     @endphp
                                     @php
                                        $data = [];
                                         for($i = 11;$i <= 20;$i++){
                                             foreach($log->tanggal_dan_jumlah_kegiatan as $tgl_dan_jml){
                                                if($tgl_dan_jml['tanggal'] == $i){
                                                    $data = $tgl_dan_jml['no_rm'];
                                                }
                                             }
                                            }
                                        echo "<td style='text-align:center;border: 1px solid #000;' class='table-primary'>". count($data) ."</td>";
                                        @endphp
                                     @php
                                        $data = [];
                                         for($i = 21;$i <= 30;$i++){
                                             foreach($log->tanggal_dan_jumlah_kegiatan as $tgl_dan_jml){
                                                if($tgl_dan_jml['tanggal'] == $i){
                                                    $data = $tgl_dan_jml['no_rm'];
                                                }
                                             }
                                            }
                                        echo "<td style='text-align:center;border: 1px solid #000;' class='table-primary'>". count($data) ."</td>";
                                         
                                     @endphp
                                     <td style="text-align:center;border: 1px solid #000;" class="text-center">
                                         {{ $log->total_kegiatan }}
                                     </td>
                                     <td style="text-align:center;border: 1px solid #000;">
                                        {{ $log->nilai }}
                                     </td>
                                 </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <h3 class="p-5 m-5">
                                            Tidak Ada Logbook...
                                        </h3>
                                    </td>
                                </tr>
                                @endforelse
                             <tr>
                                <td style="text-align:center;border: 1px solid #000;" colspan="8" class="text-center table-warning">Jumlah Total</td>
                                <td style="text-align:center;border: 1px solid #000;" colspan="1"class="table-primary">{{ $bukuputih->sum('nilai') }}</td>
                             </tr>
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>