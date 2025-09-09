@slot('title','Daftar Barang')
@slot('subtitle','Detail Barang')
@slot('icon','detail')



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="product-detai-imgs">
                            <div class="">
                              
                                <div class=" offset-md-1 d-print-none">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="product-1" role="tabpanel" aria-labelledby="product-1-tab">
                                            <div>
                                                <img src="/assets/{{ ($produk->produk->gambar) ? $produk->produk->gambar : 'produk/default-barang.png' }}" alt="" class="img-fluid mx-auto d-block">
                                            </div>
                                        </div>
                                        @php
                                            $tgl_kadaluarsa = ($produk->tgl_kadaluarsa) ? $produk->tgl_kadaluarsa->format('d F Y') : '-';
                                        @endphp
                                        <div class="tab-pane fade" id="product-2" role="tabpanel" aria-labelledby="product-2-tab">
                                            <div>
                                                <img onclick="window.location.href='/print-QR/{{ $produk->id }}'" id="qr"  src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->generate('Nama barang : '.$produk->produk->nama_barang .'  Lokasi : '.$produk->lokasi->nama_lokasi .' ,Tanggal Kadaluarsa : '.$tgl_kadaluarsa.' ,Tanggal pembelian : '.$produk->tgl_pembelian->format('d F Y') . ', Merk : '.$produk->produk->merk .' , Kategori : '.$produk->produk->kategori->nama_kategori .' , Jumlah Awal : '.$produk->jumlah_awal .' unit , Links : '.Request::url() .',')) !!} "
                                                class="img-fluid mx-auto d-block">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="text-center">
                                        <button type="button" class="btn btn-primary waves-effect waves-light mt-2 me-1">
                                            <i class="bx bx-cart me-2"></i> Add to cart
                                        </button>
                                        <button type="button" class="btn btn-success waves-effect  mt-2 waves-light">
                                            <i class="bx bx-shopping-bag me-2"></i>Buy now
                                        </button>
                                    </div> --}}
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 d-print-none">
                        <div class="mt-4 mt-xl-3">
                            <a href="javascript: void(0);" class="text-primary">{{ $produk->lokasi->nama_lokasi }}</a>
                            <h4 class="mt-1 ">{{ $produk->produk->nama_barang }} {{ {{ $produk->codeprodukid }} }}</h4>

                            <p class="text-muted mb-4">( {{ $produk->produk->kategori->nama_kategori }} )</p>

                            <h6 class="text-success text-uppercase">{{ $produk->tgl_pembelian->format('d F Y') }} </h6>

                            <h5 class="mb-4">Jumlah / Stok : <span class="text-muted me-2"><del>{{ $produk->jumlah_awal }} Unit</del></span> <b>{{ $produk->jumlah_akhir }}</b> Unit</h5>
                            <p class="text-muted mb-4">{{ $produk->produk->keterangan }}</p>
                            

                           
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="mt-5 d-print-none">
                    <h5 class="mb-2">Detail Lengkap :</h5>
                 

                    <div class="table-responsive">
                        <table class="table mb-0 table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row" style="width: 400px;">Kode Produk</th>
                                    <td>{{ $produk->codeprodukid }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width: 400px;">Nama Barang</th>
                                    <td>{{ $produk->produk->nama_barang }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" style="width: 400px;">Lokasi</th>
                                    <td>{{ $produk->lokasi->nama_lokasi }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Pembelian</th>
                                    <td>{{ $produk->tgl_pembelian->format('d F Y') }} ({{ $produk->tgl_pembelian->diffForHumans() }})</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tanggal Kadaluarsa</th>
                                    @if ($produk->tgl_kadaluarsa == null)
                                        <td> - </td>
                                    @else
                                        <td>{{ $produk->tgl_kadaluarsa->format('d F Y') }} ({{ $produk->tgl_kadaluarsa->diffForHumans() }})</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th scope="row">Merk</th>
                                    <td>{{ $produk->produk->merk }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Kategori</th>
                                    <td>{{ $produk->produk->kategori->nama_kategori }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Jumlah Awal</th>
                                    <td>{{ $produk->jumlah_awal }} Unit</td>
                                </tr>
                                <tr>
                                    <th scope="row">Jumlah Akhir</th>
                                    <td>{{ $produk->jumlah_akhir }} Unit</td>
                                </tr>
                                <tr>
                                    <th scope="row">Keterangan</th>
                                    <td>{{ $produk->produk->keterangan }} Unit</td>
                                </tr>
                                @if ($produk->produk->gambar)
                                    
                                
                                @else
                                
                                <tr>
                                    <th scope="row">Status Rencana Belanja</th>
                                    <td><span class="badge bg-info">SEDANG DI PROSES RENCANA BELANJA</span></td>
                                </tr>

                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end Specifications -->
            </div>
        </div>
        <!-- end card -->
    </div>
</div>
<!-- end row -->