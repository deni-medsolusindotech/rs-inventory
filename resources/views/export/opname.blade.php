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
            
                    <div class="table-responsive">
                        <table  id="" class="table table-sm table-bordered w-100">
                            <thead class="table-light">
                                <tr>
                                    <td colspan="2" style="">  <img src="{{ public_path('logo-2.png') }}" width="100" style="width:70px;margin:auto;" alt=""></td>
                                    <td colspan="1" style="">  <img src="{{ public_path('logo.png') }}" width="100" style="width:70px;margin:auto;" alt=""></td>
                                    <td colspan="5" style="">  <h1 style="font-size: 100px;"> RSUD Malangbong <i> - Export Data Stok Opname </i> - {{ date('d F Y') }} @if($lokasi_id) - lokasi : {{ $produks->first()->lokasi->nama_lokasi }} @endif - oleh: {{ auth()->user()->name }} </h1></td>
                                </tr>
                                <tr style="background-color: green">
                                    <th class="align-middle" style="height:30px;width:50px;text-align:center; " >No</th>
                                    <th class="align-middle" style="height:30px;text-align:center;width:200px; border: 1px solid #000;">Kode Produk</th>
                                    <th class="align-middle" style="height:30px;text-align:center;width:200px; border: 1px solid #000;">Nama Barang</th>
                                    <th class="align-middle" style="height:30px;text-align:center;width:200px; border: 1px solid #000;">Merk</th>
                                    <th class="align-middle" style="height:30px;text-align:center; border: 1px solid #000; width:150px;">Kategori</th>
                                    <th class="align-middle" style="height:30px;text-align:center; border: 1px solid #000; width:150px;">Tanggal Pembelian</th>
                                    <th class="align-middle" style="height:30px;text-align:center; border: 1px solid #000; width:150px;">Jumlah Awal</th>
                                    <th class="align-middle" style="height:30px;text-align:center; border: 1px solid #000; width:150px;">Jumlah Akhir</th>
                                    <th class="align-middle" style="height:30px;text-align:center; border: 1px solid #000; ">Lokasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($produks as  $index => $p)
                                <tr > 
                                    <td style="text-align:center;width:50px; border: 1px solid #000;">{{ $no++ }}</td>
                                    <td style='text-align:center; border: 1px solid #000;'> {{ $p->codeprodukid }} </td>
                                    <td style='text-align:center; border: 1px solid #000;'> {{ $p->produk->nama_barang }} </td>
                                    <td style='text-align:center; border: 1px solid #000;'> {{ $p->produk->merk }} </td>
                                    <td style='text-align:center; border: 1px solid #000;'> {{ $p->produk->kategori->nama_kategori }} </td>
                                    <td style='text-align:center; border: 1px solid #000;'> {{ $p->tgl_pembelian->format('d F Y') }} </td>
                                    <td style='text-align:center; border: 1px solid #000;'> {{ $p->jumlah_awal }} unit</td>
                                    <td style='text-align:center; border: 1px solid #000;'> {{ $p->jumlah_akhir }} unit</td>
                                   
                                    <td style='text-align:center; border: 1px solid #000;width:200px;'>
                                        {{ str(str()->title($p->lokasi->nama_lokasi))->replace('_',' ')  }}
                                    </td>
                                </tr>
                               
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
