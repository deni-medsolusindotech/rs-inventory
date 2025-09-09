<div>
    
    @slot('title','Aproval Pengajuan')
    @slot('subtitle','Buat Pengajuan Kebutuhan')
    @slot('icon','download')
    
    @push('script-bottom')
        {{-- select2 --}}
        <script src="/assets/libs/select2/js/select2.min.js"></script>
        <script src="/assets/js/pages/form-advanced.init.js"></script>
    @endpush
    
    @push('style')
        {{-- select2 --}}
        <link href="assets/libs/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css" />
      
    @endpush
    @push('script')
    <script>
   function terima(){
        Swal.fire({
            title: "Anda Yakin?",
            text: "Terima pengajuan kebutuhan {{ $pengajuan->nama_barang }} dari {{ $pengajuan->by->name }} untuk lokasi {{ $pengajuan->lokasi->nama_lokasi }} dan buat rencana belanja",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya, Terima!",
            cancelButtonText: "Tidak, Batal!",
            confirmButtonClass: "btn btn-primary mt-2",
            cancelButtonClass: "btn btn-secondary ms-2 mt-2",
            buttonsStyling: !1
        })
        .then(function (result) {
            if(result.isConfirmed){
               @this.terima();
            }
           
        })
     }
     function tolak() {
        Swal.fire({
            title: "Anda yakin?",
            text: "Tolak pengajuan kebutuhan {{ $pengajuan->nama_barang }} dari {{ $pengajuan->by->name }} untuk lokasi {{ $pengajuan->lokasi->nama_lokasi }}?",
            input: 'textarea',
            inputPlaceholder: 'Masukkan alasan penolakan...',
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya, Tolak",
            cancelButtonText: "Tidak, Batal",
            confirmButtonClass: "btn btn-danger mt-2",
            cancelButtonClass: "btn btn-secondary ms-2 mt-2",
            buttonsStyling: !1
        }).then((result) => {
            if (result.isConfirmed) {
                @this.tolak(result.value)
                // Tindakan jika tombol "Ya, Terima" ditekan
                // Lakukan tindakan terkait penerimaan
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Tindakan jika tombol "Tidak, Batal" ditekan atau SweetAlert ditutup
                // Lakukan tindakan terkait pembatalan
            }
        });
    }
    </script>
    
@endpush
    <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <a href="/aproval-pengajuan" class="btn btn-secondary waves-effect waves-light float-end "><i class="bx bx-arrow-back"></i> kembali</a>
                            <div class="mb-4">
                                <img src="/image/logo.png" alt="logo" height="50"/>
                                {{-- <h4 class="float-end font-size-16"># Pengajuan Kebutuhan</h4> --}}
                            </div>
                        </div>
                        @if($pengajuan->status != 'proses')
                            <div class="row mb-4 mt-0 pt-0 px-4">
                                <hr>
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
                                    <i class="bx bx-user"></i> {{ $pengajuan->by->name }} ( <i class="bx bx-map"></i> {{ $pengajuan->lokasi->nama_lokasi }})<br>
                                    <i> {{ auth()->user()->nomor_hp }} </i>
                                    </address>
                                </div>
                            </div>
                        @else
                            <div class="col-md-12 text-sm-end px-4">
                                <hr>
                                <address class="mt-2 mt-sm-0">
                                    {{ $pengajuan->created_at->format('d F Y') }}<br>
                                <i class="bx bx-user"></i> {{ $pengajuan->by->name }} ( <i class="bx bx-map"></i> {{ $pengajuan->lokasi->nama_lokasi }})<br>
                                <i> {{ auth()->user()->nomor_hp }} </i>
                                </address>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-5 mb-2 ps-5">
                                Nama Barang
                            </div>
                            <div class="col-md-7 mb-2">
                               {{ $pengajuan->nama_barang }}
                            </div>
                            <div class="px-5">
                                <hr>
                            </div>
                            <div class="col-md-5 mb-2 ps-5">
                                Jenis / Kategori
                            </div>
                            <div class="col-md-7 mb-2">
                                {{-- @if ($data['jenis'])
                                <form wire:submit.prevent="$set('data.jenis',0)">
                                    <div class="input-group">
                                        <input wire:model="pengajuan.jenis" type="text" class="form-control" placeholder="Jenis / kategori barang">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"> <i class="bx bx-save"></i> </button>
                                        </div>
                                    </div>
                                </form>
                                @else
                                    <u wire:click="$set('data.jenis',1)" data-turbolinks="false">{{ ($pengajuan->jenis) ? $pengajuan->jenis : 'Jenis / Kategori' }}</u>
                                    @endif --}}
                                    {{ $pengajuan->jenis }}
                            </div>
                            <div class="px-5">
                                <hr>
                            </div>
                            <div class="col-md-5 mb-2 ps-5">
                                Jumlah
                            </div>
                            <div class="col-md-7 mb-2">
                                {{ $pengajuan->jumlah }} Unit
                            </div>
                            <div class="px-5">
                                <hr>
                            </div>
                            <div class="col-md-5 mb-2 ps-5">
                                Deskripsi
                            </div>
                            <div class="col-md-7 mb-2">
                                {{ $pengajuan->deskripsi }}
                            </div>
                            <div class="px-5">
                                <hr>
                            </div>
                        </div>
                       
                        @if ($showbelanja)
                            <h5 class="text-center"># Data Rencana Belanja</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-5 mb-2 ps-5">
                                    Nama Barang
                                </div>
                                <div class="col-md-7 mb-2">
                                    @if ($belanja)
                                        <form wire:submit.prevent="$set('belanja',0)">
                                            <div class="input-group">
                                                <input wire:model="produk.nama_barang" type="text" class="form-control" placeholder="Nama Barang">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit"> <i class="bx bx-save"></i> </button>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        <u wire:click="$set('belanja',1)">{{ $produk->nama_barang }}</u>
                                    @endif
                                </div>
                                <div class="px-5">
                                    <hr>
                                </div>
                                <div class="col-md-5 mb-2 ps-5">
                                    Kategori
                                </div>
                                <div class="col-md-7 mb-2">
                                    @if ($belanja)
                                        <form wire:submit.prevent="$set('belanja',0)">
                                            <div class="input-group">
                                                <select wire:model="produk.kategori_id" type="text" class="form-control">
                                                    <option value="">Pilih Kategori</option>
                                                    @foreach ($allkategori as $k)
                                                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit"> <i class="bx bx-save"></i> </button>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        <u wire:click="$set('belanja',1)">{{ ($produk->kategori_id) ? $allkategori->where('id',$produk->kategori_id)->first()->nama_kategori : 'pilih kategori' }}</u>
                                    @endif
                                </div>
                                <div class="px-5">
                                    <hr>
                                </div>
                                <div class="col-md-5 mb-2 ps-5">
                                    Merk
                                </div>
                                <div class="col-md-7 mb-2">
                                    @if ($belanja)
                                        <form wire:submit.prevent="$set('belanja',0)">
                                            <div class="input-group">
                                                <input wire:model="produk.merk" type="text" class="form-control" placeholder="Merk">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit"> <i class="bx bx-save"></i> </button>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        <u wire:click="$set('belanja',1)">{{ ($produk->merk) ? $produk->merk : 'Isi Jenis / Merk' }}</u>
                                    @endif
                                </div>
                                <div class="px-5">
                                    <hr>
                                </div>
                                <div class="col-md-5 mb-2 ps-5">
                                    Keterangan Produk
                                </div>
                                <div class="col-md-7 mb-2">
                                    @if ($belanja)
                                        <form wire:submit.prevent="$set('belanja',0)">
                                            <div class="input-group">
                                                <textarea wire:model="produk.keterangan"  class="form-control" placeholder="keterangan produk" id="" cols="30" rows="10"></textarea>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit"> <i class="bx bx-save"></i> </button>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        <u wire:click="$set('belanja',1)">{{ ($produk->keterangan) ? $produk->keterangan : 'Isi keterangan' }}</u>
                                    @endif
                                </div>
                                <div class="px-5">
                                    <hr>
                                </div>
                            <div class="col-md-5 mb-2 ps-5">
                                    Jumlah
                                </div>
                                <div class="col-md-7 mb-2">
                                    @if ($belanja)
                                        <form wire:submit.prevent="$set('belanja',0)">
                                            <div class="input-group">
                                                <input wire:model="codeproduk.jumlah_awal" type="number" class="form-control" >
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit"> <i class="bx bx-save"></i> </button>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        <u wire:click="$set('belanja',1)">{{ $codeproduk->jumlah_awal }} unit</u>
                                    @endif
                                </div>
                                <div class="px-5">
                                    <hr>
                                </div>
                            <div class="col-md-5 mb-2 ps-5">
                                    Rencana Tanggal Belanja
                                </div>
                                <div class="col-md-7 mb-2">
                                    @if ($belanja)
                                        <form wire:submit.prevent="$set('belanja',0)">
                                            <div class="input-group">
                                                <input wire:model="codeproduk.tgl_pembelian" onchange="changetanggal()" type="date" class="form-control" >
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit"> <i class="bx bx-save"></i> </button>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        <u wire:click="$set('belanja',1)">{{ ($codeproduk->tgl_pembelian) ? $codeproduk->tgl_pembelian : 'Isi Rencana tanggal pembelian'  }}</u>
                                    @endif
                                </div>
                                <div class="px-5">
                                    <hr>
                                </div>
                                @if($pengajuan->status == 'tolak')
                                    <div class="border border-danger text-center">
                                        <p class="text-muted p-auto m-auto">{{ $pengajuan->confirmation->alasan }}</p>
                                    </div>
                                @endif
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
                                @if ($pengajuan->status == 'proses')

                                    <div class="d-print-none">
                                        <div class="d-flex justify-content-center pt-3">
                                            <a href="javascript: void(0);"  @if(!$errors->any()) onclick="terima()"  @endif class="btn btn-success w-md waves-effect waves-light  me-1"><i class="bx bx-check-circle"></i> Terima dan Buat Rencana belanja</a>
                                            <a href="javascript: void(0);" wire:click="showbelanja(0)" class="btn btn-secondary w-md waves-effect waves-light  me-1"><i class="bx bx-x-circle"></i> Batal</a>
                                        </div>
                                    </div>
                                @endif
                        @else
                            <div class="d-print-none">
                                <div class="d-flex justify-content-center pt-3">
                                    <a href="javascript: void(0);" wire:click="showbelanja()" class="btn btn-success w-md waves-effect waves-light  me-1"><i class="bx bx-check-circle"></i> Terima</a>
                                    <a href="javascript: void(0);" onclick="tolak()" class="btn btn-danger w-md waves-effect waves-light  me-1 "><i class="bx bx-x-circle"></i> Tolak</a>
                                </div>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    
    
    </div>