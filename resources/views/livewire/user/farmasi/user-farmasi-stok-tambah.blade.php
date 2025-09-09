@slot('title','Stok Opname ( farmasi )')
@slot('subtitle',' Stok Pengeluaran')
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
                    <form wire:submit.prevent="save" class="row gy-2 gx-3 align-items-center">
                        <div class="search-box d-inline-block me-5 col-sm-auto ">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search..." wire:model="search">
                                <i class="bx bx-search-alt search-icon"></i>
                            </div>
                        </div>
                        <div class="col-sm-auto">
                            <label class="visually-hidden" for="autoSizingInput">Name</label>
                            <select onmouseover="$(this).select2()" onchange="@this.set('farmasi.produk',$(this).val());" class="form-control" id="autoSizingInput" style="min-width:500px;" placeholder="Jane Doe">
                                <option  @if($farmasi->produk == null) selected @endif  value="">Pilih Produk </option>
                                @foreach ($produk as $p)
                                    <option @if($farmasi->produk == $p->id) selected @endif value="{{ $p->id }}">{{ $p->produk->nama_barang }} ({{ $p->produk->kategori->nama_kategori }}) Tersisa {{ $p->jumlah_akhir }} Unit</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-auto">
                            <label class="visually-hidden" for="autoSizingInputGroup">Jumlah</label>
                            <div class="input-group">
                                <div class="input-group-text bg-danger text-light" style="cursor:pointer;" wire:click="number('kurang')">-</div>
                                <input type="number" wire:model="farmasi.jumlah" class="form-control" id="autoSizingInputGroup" style="width:100px;" placeholder="Jumlah">
                                <div class="input-group-text bg-success text-light" style="cursor:pointer;" wire:click="number('tambah')">+</div>
                            </div>
                        </div>
                        <div class="col-sm-auto">
                            <button type="submit" class="btn btn-primary w-md"> <i class="bx bx-export"></i> Simpan Pengeluaran</button>    
                        </div>
                    </form>
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
                                    <th class="align-middle">Nama Barang</th>
                                    <th class="align-middle">Merk</th>
                                    <th class="align-middle">Kategori</th>
                                    <th class="align-middle">Tanggal Pembelian</th>
                                    <th class="align-middle">Tanggal Kadaluarsa</th>
                                    <th class="align-middle">Jumlah Awal</th>
                                    <th class="align-middle">Dikurangi</th>
                                    <th class="align-middle">Jumlah Akhir</th>
                                    <th class="align-middle">Gambar</th>
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