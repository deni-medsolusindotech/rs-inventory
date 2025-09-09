@slot('title','Stok Opname ( farmasi )')
@if ($pengeluaran_seminggu_terakhir)
    @slot('subtitle',' Stok Pengeluaran Seminggu Terakhir')
@else
    @slot('subtitle',' Stok Pengeluaran')
@endif
@slot('icon','detail')
@push('body')
data-keep-enlarged="true" class="vertical-collpsed"
@endpush
@push('script-bottom')
{{-- select2 --}}
<script src="/assets/libs/select2/js/select2.min.js"></script>
@endpush

@push('style')
{{-- select2 --}}

<link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
@endpush

<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="search-box d-inline-block me-5 col-sm-auto ">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search..." wire:model="search">
                                <i class="bx bx-search-alt search-icon"></i>
                            </div>
                        </div>
                        <div class="mx-0 px-0 ">
                            <div class="position-relative">
                                <input type="date" class="form-control" placeholder="Search..." wire:model="date_filter">
                            </div>
                        </div>
                        <div class="col-sm-auto">
                            @if ($pengeluaran_seminggu_terakhir)
                                <button type="button" onclick="Turbolinks.visit('/laporan-stok-farmasi-pengeluaran')" class="btn btn-info "> <i class="bx bx-export"></i> Semua Pengeluaran </button>    
                            @else
                                <button type="button" onclick="Turbolinks.visit('/laporan-stok-farmasi-pengeluaran?pengeluaran_seminggu_terakhir=1')" class="btn btn-primary "> <i class="bx bx-export"></i> Pengeluaran Seminggu Terakhir</button>    
                            @endif
                        </div>
                    </div>
                    <hr>
                    @if ($pesan || $errors->any())
                        <div class="my-1">
                            <div class="alert alert-{{ ($pesan) ? 'success' : 'danger' }}">
                                {{ ($pesan) ? $pesan : $errors->all()[0] }}    
                            </div>                        
                        </div>
                        <hr>
                    @endif
                    <div class="table-responsive pt-2">
                        <table class="table table-hover dt-responsive nowrap table-sm" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    
                                    <th class="align-middle">No</th>
                                    <th class="align-middle">Kode Produk</th>
                                    <th class="align-middle">Nama Barang</th>
                                    <th class="align-middle">Merk</th>
                                    <th class="align-middle">Kategori</th>
                                    <th class="align-middle">Tanggal Pembelian</th>
                                    <th class="align-middle">Tanggal Kadaluarsa</th>
                                    <th class="align-middle">Jumlah Awal</th>
                                    <th class="align-middle">Dikurangi</th>
                                    <th class="align-middle">Jumlah Akhir</th>
                                    <th class="align-middle">Gambar</th>
                                    <th class="align-middle">By</th>
                                    <th class="align-middle">#</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                    $no = 1;
                                @endphp
                                @foreach($stok as $p)
                                <tr>
                                    
                                    <td>{{ $no++ }}</td>
                                    <td> {{ $p->codeproduk->codeprodukid }} </td>
                                    <td> {{ $p->codeproduk->produk->nama_barang }} </td>
                                    <td> {{ $p->codeproduk->produk->merk }} </td>
                                    <td> {{ $p->codeproduk->produk->kategori->nama_kategori }} </td>
                                    <td> {{ $p->codeproduk->tgl_pembelian->format('d F Y') }} </td>
                                    <td> {{ ($p->codeproduk->tgl_kadaluarsa) ? $p->codeproduk->tgl_kadaluarsa->format('d F Y') : '-' }} </td>
                                    <td>
                                        {{ $p->codeproduk->jumlah_awal }} Unit
                                    </td>
                                    <td>
                                      <b class="text-danger"> - {{ $p->jumlah}} Unit </b>
                                    </td>
                                    <td>
                                      <b>  {{ $p->codeproduk->jumlah_akhir }} Unit </b>
                                    </td>
                                    <td> 
                                        <button class="btn btn-transparent waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#foto-{{ $p->id }}" ><img src="/assets/{{ $p->codeproduk->produk->gambar }}" class="avatar-sm" alt=""></button>
                                     </td> 
                                     <td>
                                        {{ $p->by->name }}
                                     </td>
                                    <td> 
                                        @if ($p->created_at->format('d F Y') == date('d F Y') && $p->author == auth()->user()->id)
                                            <button wire:click="batal({{ $p->id }})" class="btn btn-danger btn-sm" > <i class="bx bx-x"></i> Batal </button>
                                        @else
                                            {{ $p->created_at->format('d F Y') }}
                                        @endif
                                     </td> 
                                </tr>
                                <div id="foto-{{ $p->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="/assets/{{ $p->codeproduk->produk->gambar}}" class="img-fluid " style="max-height: 850px;min-width:460px;">    
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                @endforeach
                            </tbody>
                        </table>
                        <div class="float-end">
                            {{ $stok->links() }}
                        </div>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
    </div>
</div>