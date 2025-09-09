<div>
    
    @slot('title','Pengajuan Kebutuhan')
    @slot('subtitle','Detail Pengajuan')
    @slot('icon','receipt')
    
    @push('script-bottom')
        {{-- select2 --}}
        <script src="/assets/libs/select2/js/select2.min.js"></script>
    @endpush
    
    @push('style')
        {{-- select2 --}}

        <link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    @endpush
    
    <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <h4 class="float-end font-size-16"># Pengajuan Kerusakan</h4>
                            <div class="mb-1">
                                <img src="/image/logo.png" alt="logo" height="50"/>
                            </div>
                            <hr>
                        </div>
                        @if($pengajuan->status != 'proses')
                            <div class="row mb-4 mt-0 pt-0 px-4">
                                <div class="col-sm-6">
                                    <address>
                                        {{ $pengajuan->confirmation->updated_at->format('d F Y') }}<br>
                                        <i class="bx bx-user"></i> {{ $pengajuan->confirmation->author->name }}<br>
                                        <span class="badge @if($pengajuan->status == 'proses') bg-info @elseif ($pengajuan->status == 'terima') bg-success @else bg-danger @endif">di {{ $pengajuan->status }} </span>
                                    </address>
                                </div>
                                <div class="col-sm-6 text-sm-end">
                                    <address class="pt-0">
                                        {{ $pengajuan->created_at->format('d F Y') }}<br>
                                    <i class="bx bx-user"></i> {{ $pengajuan->by->name }} ( <i class="bx bx-map"></i> {{ $pengajuan->produkrusak->lokasi->nama_lokasi }})<br>
                                    <i> {{ $pengajuan->by->nomor_hp }} </i>
                                    </address>
                                </div>
                            </div>
                        @else
                            <div class="col-md-12 text-sm-end px-4">
                                <address class="mt-2 mt-sm-0">
                                    {{ $pengajuan->created_at->format('d F Y') }}<br>
                                <i class="bx bx-user"></i> {{ $pengajuan->by->name }} ( <i class="bx bx-map"></i> {{ $pengajuan->produkrusak->lokasi->nama_lokasi }})<br>
                                <i> {{ $pengajuan->by->nomor_hp }} </i>
                                </address>
                            </div>
                        @endif
                        <div class="row">
                          
                            @if ($pengajuan->produk)
                                <div class="px-5">
                                    <table class="table mb-0 table-bordered">
                                        <tbody>
                                            <tr>
                                                <th scope="row" style="width: 400px;">Kode Produk</th>
                                                <td>{{ $pengajuan->produkrusak->produk->codeproduk->codeprodukid }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 400px;">Nama Barang</th>
                                                <td>{{ $pengajuan->produkrusak->produk->nama_barang }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 400px;">Lokasi</th>
                                                <td>{{ $pengajuan->produkrusak->lokasi->nama_lokasi }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tanggal Pembelian</th>
                                                <td>{{ $pengajuan->produkrusak->tgl_pembelian->format('d F Y') }} ({{ $pengajuan->produkrusak->tgl_pembelian->diffForHumans() }})</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tanggal Kadaluarsa</th>
                                                @if ($pengajuan->produkrusak->tgl_kadaluarsa == null)
                                                    <td> - </td>
                                                @else
                                                    <td>{{ $pengajuan->produkrusak->tgl_kadaluarsa->format('d F Y') }} ({{ $pengajuan->produkrusak->tgl_kadaluarsa->diffForHumans() }})</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <th scope="row">Merk</th>
                                                <td>{{ $pengajuan->produkrusak->produk->merk }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Kategori</th>
                                                <td>{{ $pengajuan->produkrusak->produk->kategori->nama_kategori }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Lokasi</th>
                                                <td>{{ $pengajuan->produkrusak->lokasi->nama_lokasi }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Jumlah Awal</th>
                                                <td>{{ $pengajuan->produkrusak->jumlah_awal }} Unit</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Jumlah Akhir</th>
                                                <td>{{ $pengajuan->produkrusak->jumlah_akhir }} Unit</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Keterangan</th>
                                                <td>{{ $pengajuan->keterangan }} Unit</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Gambar</th>
                                                <td> <img src="/assets/{{ ($pengajuan->produkrusak->produk->gambar) ? $pengajuan->produkrusak->produk->gambar : 'produk/default-barang.png' }}" alt="produk" style="min-width:500px;"> </td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                            <div class="px-5">
                                <hr>
                            </div>  

                           
                            <div class="col-md-5 mb-2 ps-5">
                                Jumlah Hilang / Rusak
                            </div>
                            <div class="col-md-7 mb-2">
                                <b class="text-danger"> -  {{ $pengajuan->jumlah }} Unit </b>
                            </div>
                            <div class="px-5">
                                <hr>
                            </div>
                            <div class="col-md-5 mb-2 ps-5">
                                Keterangan
                            </div>
                            <div class="col-md-7 mb-2">
                                {{ $pengajuan->keterangan }}
                            </div>
                            <div class="px-5">
                                <hr>
                            </div>
                            <div class="col-md-5 mb-2 ps-5">
                                Bukti
                            </div>
                            <div class="col-md-7 mb-2">
                                <img src="/assets/{{ $pengajuan->bukti }}" style="min-width:500px;">
                            </div>
                            <div class="px-5">
                                <hr>
                            </div>
                            @if($pengajuan->status == 'tolak')
                                <div class="border border-danger text-center px-5">
                                    <p class="text-danger p-auto m-auto">{{ $pengajuan->confirmation->alasan }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <a href="/pengajuan-kerusakan" class="btn btn-secondary btn-sm"> <i class="bx bx-arrow-back"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    
    </div>