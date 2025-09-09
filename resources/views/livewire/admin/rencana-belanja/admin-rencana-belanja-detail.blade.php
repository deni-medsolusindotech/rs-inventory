<div>
    
    @slot('title','Rencana Belanja')
    @slot('subtitle','Detail')
    @slot('icon','bx-cart-alt')
    
    @push('script-bottom')
        {{-- select2 --}}
        <script src="/assets/libs/select2/js/select2.min.js"></script>
    @endpush

    @push('style')
        <link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        {{-- select2 --}}
        <link href="/assets/libs/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css" />
      
    @endpush
    @push('script')
    <script>
        function selesai(){
                Swal.fire({
                    title: "Anda Yakin?",
                    text: "Produk {{ $produk->produk->nama_barang }} untuk lokasi {{ $produk->lokasi->nama_lokasi }} Sudah di beli",
                    icon: "warning",
                    showCancelButton: !0,
                    confirmButtonText: "Konfirmasi!",
                    cancelButtonText: "Tidak, Batal!",
                    confirmButtonClass: "btn btn-primary mt-2",
                    cancelButtonClass: "btn btn-secondary ms-2 mt-2",
                    buttonsStyling: !1
                })
                .then(function (result) {
                    if(result.isConfirmed){
                    @this.sudahbelanja();
                    }
                
                })
            }
    </script>
    @endpush
    <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <a href="/rencana-belanja" class="btn btn-secondary waves-effect waves-light float-end "><i class="bx bx-arrow-back"></i> kembali</a>
                            <div class="mb-2">
                                <img src="/image/logo.png" alt="logo" height="50"/>
                                {{-- <h4 class="float-end font-size-16"># Pengajuan Kebutuhan</h4> --}}
                            </div>
                        </div>
                        <div class="row">
                            <hr>
                            <h5 class="text-center"># Data Rencana Belanja</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-5 mb-2 ps-5">
                                    Nama Barang
                                </div>
                                <div class="col-md-7 mb-2">
                                    {{ $produk->produk->nama_barang }}
                                </div>
                                <div class="px-5">
                                    <hr>
                                </div>
                                <div class="col-md-5 mb-2 ps-5">
                                    Kategori
                                </div>
                                <div class="col-md-7 mb-2">
                                    {{ $produk->produk->kategori->nama_kategori }}
                                </div>
                                <div class="px-5">
                                    <hr>
                                </div>
                                <div class="col-md-5 mb-2 ps-5">
                                    Merk
                                </div>
                                <div class="col-md-7 mb-2">
                                    {{ $produk->produk->merk }}
                                </div>
                                <div class="px-5">
                                    <hr>
                                </div>
                                <div class="col-md-5 mb-2 ps-5">
                                    Keterangan Produk
                                </div>
                                <div class="col-md-7 mb-2">
                                    {{ $produk->produk->keterangan }}
                                </div>
                                <div class="px-5">
                                    <hr>
                                </div>
                            <div class="col-md-5 mb-2 ps-5">
                                    Jumlah
                                </div>
                                <div class="col-md-7 mb-2">
                                    {{ $produk->jumlah_awal }} Unit
                                </div>
                                <div class="px-5">
                                    <hr>
                                </div>
                            <div class="col-md-5 mb-2 ps-5">
                                    Rencana Tanggal Belanja
                                </div>
                                <div class="col-md-7 mb-2">
                                    {{ $produk->tgl_pembelian->format('d F Y') }} <i>( {{ $produk->tgl_pembelian->diffForHumans() }} )</i>
                                </div>
                                <div class="px-5">
                                    <hr>
                                </div>
                                <div class="col-md-5 mb-2 ps-5">
                                    Status Produk
                                 </div>
                                 <div class="col-md-7 mb-2">
                                    @if ($produk->status_input_pengadaan)
                                        <span class="badge bg-warning badge-lg"><i class="bx bx-edit"></i> INPUT PENGADAAN</span>
                                    @else
                                        <span class="badge bg-warning badge-lg"><i class="bx bx-download"></i> PENGAJUAN</span>
                                    @endif
                                 </div>
                                 <div class="px-5">
                                     <hr>
                                 </div>

                               @if ($produk->status_rencana_belanja == 'proses')
                                   
                                    @if ($belanja)
                                    <div class="col-md-5 mb-2 ps-5">
                                        Gambar Produk
                                    </div>
                                    <div class="col-md-7 mb-2">
                                        <input type="file" class="form-control" wire:model="foto">
                                        <br>
                                        @if ($foto)
                                            <img src="{{ $foto->temporaryUrl() }}" style="max-width:500px;">
                                        @endif
                                        @error('foto') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="px-5">
                                        <hr>
                                    </div>
                                    <div class="col-md-5 mb-2 ps-5">
                                        Distribusi
                                    </div>
                                    <div class="col-md-7 row mb-2">
                                        
                                        @if($cek_distribusi && count($distribusi))
                                        @foreach ($distribusi as $index => $d)
                                            <div class="input-group mb-2" id="distribusi{{ $index }}" wire:key="{{ $index }}">
                                                <select  required class="form-control select2" id="lokasi_tujuan{{ $index }}" onmouseover="$(this).select2()" onchange="@this.set('distribusi.{{ $index }}.lokasi_id', this.value)">
                                                    <option>Pilih Lokasi</option>
                                                    @foreach ($alllokasi as $lokasi)
                                                        <option @if($distribusi[$index]['lokasi_id'] == $lokasi->id) selected @endif value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="number" wire:model="distribusi.{{ $index }}.jumlah" class="form-control input-group-btn width-10" required>
                                                <button wire:click="removedistribusi({{ $index }})" class="btn btn-danger input-group-btn"> <i class="bx bx-trash"></i> </button>
                                            </div>
                                        @endforeach
                                            <div class="row">
                                                <h6 class="border mt-1"> <i class="bx bx-info"></i> Jumlah Sisa {{ $produk->jumlah_awal }} - {{ array_sum(array_column($distribusi, 'jumlah')) }} = {{ $produk->jumlah_awal - array_sum(array_column($distribusi, 'jumlah')) }} Unit di lokasi {{ $produk->lokasi->nama_lokasi }} </h6>
                                                <button wire:click="tambahdistribusi()" class="btn btn-sm btn-success "> <i class="bx bx-add-to-queue"></i> Tambah</button>
                                            </div>
                                        @else
                                            <div>
                                                <input type="checkbox" wire:model="cek_distribusi" name="tdk_distribusi" id="tdk_distribusi">
                                                <label for="tdk_distribusi">Didistribusikan</label>
                                            </div>
                                        @endif
                                       
                                        @error('tgl_kadaluarsa') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-5 mb-2 ps-5">
                                        Tanggal Kadaluarsa
                                    </div>
                                    <div class="col-md-7 mb-2">
                                        @if(!$cek_kadaluarsa)
                                            <input type="date" class="form-control" wire:model="tgl_kadaluarsa">
                                        @endif
                                        <input type="checkbox" wire:model="cek_kadaluarsa" name="tgl_kadaluarsa" id="tgl_kadaluarsa">
                                        <label for="tgl_kadaluarsa">tidak ada kadaluarsa</label>
                                        @error('tgl_kadaluarsa') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col-md-5 mb-2 ps-5">
                                        Nomor Produk
                                    </div>
                                    <div class="col-md-7 mb-2">
                                        <input type="text" class="form-control" wire:model="codeprodukid">
                                        @error('codeprodukid') <span class="error">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="px-5">
                                        <hr>
                                    </div>
                                    @endif
                                   
                                    <div class="d-flex justify-content-center">
                                        <button type="button" @if(!$belanja) wire:click="showbelanja()" @else onclick="selesai()" @endif class="btn btn-success"><i class="bx bx-cart-alt"></i> Sudah Belanja</button>
                                    </div>
                                @else
                                    <div class="col-md-5 mb-2 ps-5">
                                        Gambar Produk
                                    </div>
                                    <div class="col-md-7 mb-2">
                                        <img src="/assets/{{ $produk->produk->gambar }}" style="max-width:500px;">
                                    </div>
                                    <div class="px-5">
                                        <hr>
                                    </div>
                                    @if($produk->distribusi)
                                        <div class="col-md-5 mb-2 ps-5">
                                            Distribusi dari {{ $produk->lokasi->nama_lokasi }}
                                        </div>
                                        <div class="col-md-7 mb-2">
                                            <ul>
                                                @foreach ($produk->distribusi as $distribusi)
                                                    <li>Ke {{ $distribusi->lokasi->nama_lokasi }} dengan jumlah {{ $distribusi->jumlah }} unit</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="px-5">
                                            <hr>
                                        </div>
                                        <div class="col-md-5 mb-2 ps-5">
                                           Jumlah Akhir
                                        </div>
                                        <div class="col-md-7 mb-2">
                                           <p>jumlah awal ({{ $produk->jumlah_awal }}) unit - jumlah distribusi ({{ $produk->distribusi->sum('jumlah') }}) unit = <b> {{ $produk->jumlah_awal - $produk->distribusi->sum('jumlah') }} unit </b></p>
                                        </div>
                                        <div class="px-5">
                                            <hr>
                                        </div>
                                    @endif
                                    <div class="col-md-5 mb-2 ps-5">
                                        Tanggal Kadaluarsa
                                    </div>
                                    <div class="col-md-7 mb-2">
                                        @if($produk->tgl_kadaluarsa)
                                            {{ $produk->tgl_kadaluarsa->format('d F Y') }} ({{ $produk->tgl_kadaluarsa->diffForHumans() }})
                                        @else
                                         <i class="bx bx-x"></i>   Tidak Ada Kadaluarsa
                                        @endif
                                    </div>
                                    <div class="px-5">
                                        <hr>
                                    </div>
                                    <div class="col-md-5 mb-2 ps-5">
                                       Status  
                                    </div>
                                    <div class="col-md-7 mb-2">
                                        <span class="badge bg-success"><i class="bx bx-check"></i> Selesai</span>
                                    </div>
                                    <div class="px-5">
                                        <hr>
                                    </div>
                               @endif
                                
                            </div>

                        </div>
                     
                    </div>
                </div>
            </div>
        </div>
    
    
    </div>