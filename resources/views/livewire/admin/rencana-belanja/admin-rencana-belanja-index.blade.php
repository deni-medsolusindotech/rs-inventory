@slot('title','Daftar Barang')
@slot('icon','user-circle')
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
                                <select onmouseover="$(this).select2()" onchange="@this.set('status', this.value)" class="form-select select2" id="kategori"  style="width:200px;">
                                    <option value=""> Semua Status </option>
                                    <option  @if($status == "proses") selected @endif value="proses"> Proses</option>
                                    <option @if($status == "selesai") selected @endif value="selesai"> Selesai</option>
                                </select>
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
                                    <th class="align-middle">Code Produk</th>
                                    <th class="align-middle">Nama Barang</th>
                                    <th class="align-middle">Merk</th>
                                    <th class="align-middle">Kategori</th>
                                    <th class="align-middle">Lokasi</th>
                                    <th class="align-middle">Jumlah</th>
                                    <th class="align-middle">Rencana Pembelian</th>
                                    <th class="align-middle">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                    $no = 1;
                                @endphp
                                @foreach($produk as $p)
                                <tr style="cursor:pointer;" onclick="Turbolinks.visit('rencana-belanja/detail/{{ $p->id }}')">
                                    
                                    <td>{{ $no++ }}</td>
                                    <td> {{ $p->codeprodukid }} </td>
                                    <td> {{ $p->produk->nama_barang }} </td>
                                    <td> {{ $p->produk->merk }} </td>
                                    <td> {{ $p->produk->kategori->nama_kategori }} </td>
                                    <td> {{ $p->lokasi->nama_lokasi }} </td>
                                    <td> {{ $p->jumlah_akhir }} unit</td>
                                    <td> {{ $p->tgl_pembelian->format('d F Y') }} 
                                    <br><i> ({{ $p->tgl_pembelian->diffForHumans() }})</i>
                                    </td>
                                    <td>
                                    @if($p->status_rencana_belanja == 'proses')
                                      <span class="badge bg-info"><i class='bx bx-hourglass'></i> PROSES</span>  
                                    @else
                                      <span class="badge bg-success "> <i class="bx bx-check-circle"></i> SELESAI</span>  
                                     @endif
                                    </td>
                                </tr>
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