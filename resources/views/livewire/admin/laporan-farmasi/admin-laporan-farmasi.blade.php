@slot('title','Laporan Stok Farmasi')
@slot('icon','export')
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
                               <a href="/laporan-stok-farmasi-pengeluaran" class="btn btn-primary"> <i class="bx bx-export"></i> Data Pengeluaran </a>
                            </div>
                        </div>

                        <div class="mx-0 px-0 ">
                            <div class="position-relative">
                                <select onmouseover="$(this).select2()" onchange="@this.set('kategori_filter', this.value)" class="form-select select2" id="kategori"  style="width:300px">
                                    <option value=""> Semua Kategori </option>
                                    @foreach($category as $c)
                                        <option @if($kategori_filter ==  $c->id) selected @endif value="{{ $c->id }}"> {{ $c->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
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
                                    <th class="align-middle">Jumlah Akhir</th>
                                    <th class="align-middle">Gambar</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                    $no = 1;
                                @endphp
                                @foreach($produk as $p)
                                <tr>
                                    
                                    <td>{{ $no++ }}</td>
                                    <td> {{ $p->codeprodukid }} </td>
                                    <td> {{ $p->produk->nama_barang }} </td>
                                    <td> {{ $p->produk->merk }} </td>
                                    <td> {{ $p->produk->kategori->nama_kategori }} </td>
                                    <td> {{ $p->tgl_pembelian->format('d F Y') }} </td>
                                    <td> {{ ($p->tgl_kadaluarsa) ? $p->tgl_kadaluarsa->format('d F Y') : '-' }} </td>
                                    <td>
                                        {{ $p->jumlah_awal }} Unit
                                    </td>
                                    <td>
                                      <b>  {{ $p->jumlah_akhir }} Unit </b>
                                    </td>
                                    <td> 
                                        <button class="btn btn-transparent waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#foto-{{ $p->id }}" ><img src="/assets/{{ $p->produk->gambar }}" class="avatar-sm" alt=""></button>
                                     </td> 
                                </tr>
                                <div id="foto-{{ $p->id }}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="/assets/{{ $p->produk->gambar}}" class="img-fluid " style="max-height: 850px;min-width:460px;">    
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                @endforeach
                            </tbody>
                        </table>
                        <div class="float-end">
                            {{ $produk->links() }}
                        </div>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
    </div>
</div>