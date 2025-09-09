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
            text: "Apakah Anda yakin ingin menerima dan mengonfirmasi data diri pengguna dengan nama ?",
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
                            <a href="/pengajuan-kebutuhan" class="btn btn-secondary waves-effect waves-light float-end "><i class="bx bx-arrow-back"></i> kembali</a>
                            <div class="mb-2">
                                <img src="/image/logo.png" alt="logo" height="50"/>
                                {{-- <h4 class="float-end font-size-16"># Pengajuan Kebutuhan</h4> --}}
                            </div>
                        </div>
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
                        <div class="row">
                            <div class="px-5">
                                <hr>
                            </div>
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
                            @if($pengajuan->status == 'tolak')
                                <div class="border border-danger text-center">
                                    <p class="text-muted p-auto m-auto">{{ $pengajuan->confirmation->alasan }}</p>
                                </div>
                            @elseif ($pengajuan->status == 'terima')
                            <h5 class="text-center"># Data Rencana Belanja</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-5 mb-2 ps-5">
                                    Nama Barang
                                </div>
                                <div class="col-md-7 mb-2">
                                    {{ $pengajuan->produk->produk->nama_barang }}
                                </div>
                                <div class="px-5">
                                    <hr>
                                </div>
                                <div class="col-md-5 mb-2 ps-5">
                                    Kategori
                                </div>
                                <div class="col-md-7 mb-2">
                                    {{ $pengajuan->produk->produk->kategori->nama_kategori }}
                                </div>
                                <div class="px-5">
                                    <hr>
                                </div>
                                <div class="col-md-5 mb-2 ps-5">
                                    Merk
                                </div>
                                <div class="col-md-7 mb-2">
                                    {{ $pengajuan->produk->produk->merk }}
                                </div>
                                <div class="px-5">
                                    <hr>
                                </div>
                                <div class="col-md-5 mb-2 ps-5">
                                    Keterangan Produk
                                </div>
                                <div class="col-md-7 mb-2">
                                    {{ $pengajuan->produk->produk->keterangan }}
                                </div>
                                <div class="px-5">
                                    <hr>
                                </div>
                            <div class="col-md-5 mb-2 ps-5">
                                    Jumlah
                                </div>
                                <div class="col-md-7 mb-2">
                                    {{ $pengajuan->produk->jumlah_awal }} Unit
                                </div>
                                <div class="px-5">
                                    <hr>
                                </div>
                            <div class="col-md-5 mb-2 ps-5">
                                    Rencana Tanggal Belanja
                                </div>
                                <div class="col-md-7 mb-2">
                                    {{ $pengajuan->produk->tgl_pembelian->format('d F Y') }} <i>( {{ $pengajuan->produk->tgl_pembelian->diffForHumans() }} )</i>
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
                            @endif
                            
                        </div>
                     
                    </div>
                </div>
            </div>
        </div>
    
    
    </div>