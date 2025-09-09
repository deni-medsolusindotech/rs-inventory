<div>
    
    @slot('title','Pengajuan Kerusakan')
    @slot('subtitle','Buat Pengajuan Kerusakan')
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
                        <div class="col-md-12 text-sm-end">
                            <address class="mt-2 mt-sm-0">
                                {{ $now }}<br>
                                {{ auth()->user()->name }} ({{ auth()->user()->getRoleNames()->first() }})<br>
                            <i> {{ auth()->user()->nomor_hp }} </i>
                            </address>
                        </div>
                        <div class="row">
                            <div class="col-md-5 mb-2 ps-5">
                                Nama Barang
                            </div>
                            <div class="col-md-7 mb-2">
                                @if ($data['nama_barang'])
                                <form wire:submit.prevent="$set('data.nama_barang',0)">
                                    <div class="pe-5">
                                        <select onmouseover="$(this).select2()" onchange="@this.set('pengajuan.produk', this.value)" name="" id="" class="form-control select2">
                                            <option value="">Pilih Barang Yang Hilang / Rusak</option>
                                            @foreach ($allproduk as $produk)
                                                <option value="{{ $produk->id }}" @if($pengajuan->produk == $produk->id) selected @endif>{{ $produk->produk->nama_barang }} ({{ $produk->produk->kategori->nama_kategori }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                                @else
                                    <u wire:click="$set('data.nama_barang',1)" onclick="setproduk()" data-turbolinks="false">{{ ($pengajuan->nama_barang) ? $pengajuan->nama_barang : 'Nama barang' }}</u>
                                @endif
                            </div>
                            
                            @if ($pengajuan->produk)
                                <div class="px-5">
                                    <hr>
                                </div>
                                <div class="px-5">
                                    <table class="table mb-0 table-bordered">
                                        <tbody>
                                            <tr>
                                                <th scope="row" style="width: 400px;">Kode Produk</th>
                                                <td>{{ $produkpilihan->codeproduk->codeprodukid }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 400px;">Nama Barang</th>
                                                <td>{{ $produkpilihan->nama_barang }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" style="width: 400px;">Lokasi</th>
                                                <td>{{ $produkpilihan->codeproduk->lokasi->nama_lokasi }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tanggal Pembelian</th>
                                                <td>{{ $produkpilihan->codeproduk->tgl_pembelian->format('d F Y') }} ({{ $produkpilihan->codeproduk->tgl_pembelian->diffForHumans() }})</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Tanggal Kadaluarsa</th>
                                                @if ($produkpilihan->codeproduk->tgl_kadaluarsa == null)
                                                    <td> - </td>
                                                @else
                                                    <td>{{ $produkpilihan->codeproduk->tgl_kadaluarsa->format('d F Y') }} ({{ $produkpilihan->codeproduk->tgl_kadaluarsa->diffForHumans() }})</td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <th scope="row">Merk</th>
                                                <td>{{ $produkpilihan->merk }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Kategori</th>
                                                <td>{{ $produkpilihan->kategori->nama_kategori }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Lokasi</th>
                                                <td>{{ $produkpilihan->codeproduk->lokasi->nama_lokasi }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Jumlah Awal</th>
                                                <td>{{ $produkpilihan->codeproduk->jumlah_awal }} Unit</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Jumlah Akhir</th>
                                                <td>{{ $produkpilihan->codeproduk->jumlah_akhir }} Unit</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Keterangan</th>
                                                <td>{{ $produkpilihan->keterangan }} Unit</td>
                                            </tr>
                                            @if ($produkpilihan->gambar)
                                                
                                            <tr>
                                                <th scope="row">Gambar</th>
                                                <td> <img src="/assets/{{ ($produkpilihan->gambar) ? $produkpilihan->gambar : 'produk/default-barang.png' }}" alt="produk" style="min-width:500px;"> </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Qrkode</th>
                                                <td>0</td>
                                            </tr>
                                            @else
                                            
                                            <tr>
                                                <th scope="row">Status Rencana Belanja</th>
                                                <td><span class="badge bg-info">SEDANG DI PROSES RENCANA BELANJA</span></td>
                                            </tr>
            
                                            @endif
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
                                @if ($data['nama_barang'])
                                <form wire:submit.prevent="$set('data.jumlah',0)" >
                                    <div class="input-group pe-5">
                                        <div class="input-group-append">
                                            <button class="btn btn-danger" wire:click="number('kurang')" type="button"> - </button>
                                        </div>
                                        <input wire:model="pengajuan.jumlah" type="number" class="form-control" placeholder="Input Jumlah">
                                        <div class="input-group-append">
                                            <button class="btn btn-success" wire:click="number('tambah')" type="button"> + </button>
                                        </div>
                                    </div>
                                </form>
                                @else
                                    <u wire:click="$set('data.nama_barang',1)" data-turbolinks="false">{{ ($pengajuan->jumlah) ? $pengajuan->jumlah.' unit' : 'Jumlah Barang' }}</u>
                                @endif
                            </div>
                            <div class="px-5">
                                <hr>
                            </div>
                            <div class="col-md-5 mb-2 ps-5">
                                Keterangan
                            </div>
                            <div class="col-md-7 mb-2">
                                @if ($data['nama_barang'])
                                <form wire:submit.prevent="$set('data.nama_barang',0)" class="ps-1">
                                    <textarea class="form-control" wire:model="pengajuan.keterangan"  wire:keydown.enter="$set('data.nama_barang',0)" style="max-width: 530px;min-width: 450px;" cols="50" rows="10"></textarea>
                                </form>
                                @else
                                    <u wire:click="$set('data.nama_barang',1)" data-turbolinks="false">{{ ($pengajuan->keterangan) ? $pengajuan->keterangan : 'keterangan' }}</u>
                                @endif
                            </div>
                            <div class="px-5">
                                <hr>
                            </div>
                            <div class="col-md-5 mb-2 ps-5">
                                Bukti
                            </div>
                            <div class="col-md-7 mb-2">
                                @if ($data['nama_barang'])
                                <form wire:submit.prevent="$set('data.nama_barang',0)">
                                    <div class="pe-5">
                                        <input type="file" class="form-control" wire:model="bukti">
                                        @if ($bukti)
                                            <br>
                                            <img src="{{ $bukti->temporaryUrl() }}" style="max-width:500px;">
                                        @endif
                                    </div>
                                </form>
                                @else
                                    <u wire:click="$set('data.nama_barang',1)" data-turbolinks="false">@if($bukti) <img src="{{ $bukti->temporaryUrl() }}" style="max-width:500px;"> @else Upload Bukti @endif</u>
                                @endif
                            </div>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger mx-4">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <div class="d-print-none">
                                <div class="d-flex justify-content-center pt-3">
                                    <a href="javascript: void(0);" wire:click="buatpengajuan" class="btn btn-primary w-md waves-effect waves-light  me-1"><i class="bx bx-save"></i> Buat Pengajuan</a>
                                    <a href="/pengajuan-kebutuhan" class="btn btn-secondary waves-effect waves-light "><i class="bx bx-x"></i> batal</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    
    
    </div>