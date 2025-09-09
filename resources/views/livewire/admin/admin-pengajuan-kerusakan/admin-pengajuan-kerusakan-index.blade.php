
<div>
    @slot('title','Aproval Pengajuan')
    {{-- @slot('subtitle','Detail Barang') --}}
    @slot('icon','download')
    @push('script-bottom')
    {{-- select2 --}}
    <script src="/assets/libs/select2/js/select2.min.js"></script>
    @endpush

    @push('style')
    {{-- select2 --}}

    <link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    @endpush
    
    <div class="row">
        <div class="col-lg-12 ">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <div class="search-box d-inline-block mx-auto ">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Search..." wire:model="search">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mx-0 px-0 ">
                            <div class="position-relative">
                                <select onmouseover="$(this).select2()" onchange="@this.set('status', this.value)" class="form-select select2" id="kategori"  style="width:200px;">
                                    <option value=""> Semua Status </option>
                                    <option  @if($status == "proses") selected @endif value="proses"> Proses</option>
                                    <option @if($status == "terima") selected @endif value="terima"> Terima</option>
                                    <option @if($status == "tolak") selected @endif value="tolak"> Tolak</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($pengajuan as $p )      
            <div class="col-xl-4 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-4">
                                <div class="avatar-md">
                                    <span class="avatar-title rounded-circle bg-light text-danger font-size-16">
                                        <img src="/assets/{{ $p->by->avatar }}" alt="" style="width:100%;height:100%;" class="rounded-circle" height="30">
                                    </span>
                                </div>
                            </div>
                            
        
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="text-truncate font-size-15"><a href="javascript: void(0);" class="text-dark">{{ $p->produkrusak->produk->nama_barang }} (<i>{{ $p->produkrusak->produk->kategori->nama_kategori }}</i>)</a></h5>
                                <h6 class="text-muted">by : {{ $p->by->name }}</h6>
                                <span class="badge @if($p->status == 'proses') bg-info @elseif ($p->status == 'terima') bg-success @else bg-danger @endif"> {{ $p->status }} </span>  
                                
                                <p class="text-muted ">{{ substr($p->keterangan,0,100)  }} ...</p>
                                <a href="/aproval-rusak/detail/{{ $p->id }}" class="btn btn-primary btn-sm"><i class="bx bx-detail"></i> Detail</a>

                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 border-top">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item me-3">
                                <i class="bx bx-sitemap me-1"></i> {{ $p->jumlah }} 
                            </li>
                            <li class="list-inline-item me-3">
                                <i class= "bx bx-calendar me-1"></i> {{ $p->created_at->format('d F Y') }}
                            </li>
                            <li class="list-inline-item me-3">
                                <li class="list-inline-item me-3">
                                    <i class= "bx bx-map me-1"></i> {{ $p->produkrusak->lokasi->nama_lokasi }}
                                </li>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    
</div>