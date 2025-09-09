@slot('title','Pengajuan Kerusakan')
{{-- @slot('subtitle','Detail Barang') --}}
@slot('icon','receipt')
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
                            <select onmouseover="$(this).select2()" onchange="@this.set('status', this.value)" class="form-select select2" id="kategori"  style="width:100%">
                                <option value=""> Semua Status </option>
                                <option  @if($status == "proses") selected @endif value="proses"> Proses</option>
                                <option @if($status == "terima") selected @endif value="terima"> Terima</option>
                                <option @if($status == "tolak") selected @endif value="tolak"> Tolak</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-9">
                        <div class="table-responsive pt-2">
                            <table class="table table-hover dt-responsive nowrap table-sm" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        
                                        <th class="align-middle">No</th>
                                        <th class="align-middle">Kode Produk</th>
                                        <th class="align-middle">Nama Barang</th>
                                        <th class="align-middle">Kategori</th>
                                        <th class="align-middle">Jumlah <br> awal</th>
                                        <th class="align-middle">Jumlah <br> Rusak</th>
                                        <th class="align-middle">Tanggal Diajukan</th>
                                        <th class="align-middle">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $no = 1;
                                    @endphp
                                    @forelse($produk as $p)
                                    <tr style="cursor: pointer;" onclick="Turbolinks.visit('/pengajuan-kerusakan/detail/{{ $p->id }}')" onmouseover="$('.detail').removeClass('d-none');" onmouseout="$('.detail').addClass('d-none');">
                                        
                                        <td>{{ $no++ }}</td>
                                        <td> {{ $p->produkrusak->produk->codeproduk->codeprodukid }} </td>
                                        <td> {{ $p->produkrusak->produk->nama_barang }} </td>
                                        <td> {{ $p->produkrusak->produk->kategori->nama_kategori }} </td>
                                        <td> {{ $p->produkrusak->jumlah_akhir }} unit</td>
                                        <td> {{ $p->jumlah }} unit </td>
                                        <td> {{ $p->created_at->format('d F Y') }} </td>
                                        <td> <span class="badge @if($p->status == 'proses') bg-info @elseif ($p->status == 'terima') bg-success @else bg-danger @endif"> {{ $p->status }} </span> 
                                        </td>
                                    </tr>
                                    
                                    @empty
                                        <tr colspan="3">
                                            <td  colspan="7">
                                                <div class="border text-center align-middle p-5">
                                                    <h5>Belum ada Produk Pengajuan Kerusakan / Hilang</h5>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="float-end">
                                {{ $produk->links() }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-grid gap-2">
                            <button   onclick="window.location.href='/pengajuan-kerusakan-tambah'" type="button" class="btn btn-success waves-effect waves-light"><i class="bx bx-upload"></i> Pengajuan Kerusakan / Hilang</button>
                        </div>
                       @if ($produk->count())
                        <div class="row border mt-4">
                            <div class="col-md-4 p-3">
                                <h5> <i class='bx bx-check-circle bx-md text-success'></i> {{ $produk->where('status','terima')->count() }}</h5>
                            </div>
                            <div class="col-md-4 p-3">
                                <h5><i class='bx bx-x-circle bx-md text-danger'></i> {{ $produk->where('status','tolak')->count() }}</h5>
                            </div>
                            <div class="col-md-4 p-3">
                                <h5><i class='bx bx-hourglass bx-md text-info'></i> {{ $produk->where('status','proses')->count() }}</h5>
                            </div>
                        </div>
                       @else
                            <div class="mt-3">
                                <div class="text-center p-4 border">
                                    <h5 class="text-secondary">Belum ada Pengajuan</h5>
                                    </div>
                                </div>
                            </div>
                        @endif
                </div>
                <!-- end table-responsive -->
            </div>
        </div>

    </div>
   
</div>
