@slot('title','Kategori dan Lokasi')
@slot('icon','map-pin')
@push('script-bottom')
    <script>
        function hapus(id,nama){
        Swal.fire({
            title: "Anda Yakin?",
            text: "Hapus kategori "+nama,
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Tidak, Batal!",
            confirmButtonClass: "btn btn-danger mt-2",
            cancelButtonClass: "btn btn-secondary ms-2 mt-2",
            buttonsStyling: !1
        })
        .then(function (result) {
            if(result.isConfirmed){
               @this.hapus_kategori(id);
            }
           
        })
     }
    </script>
@endpush
<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-6">
                        <div class="my-3">
                            <form wire:submit.prevent="tambah_kategori">
                                <div class="input-group">
                                    <input type="text" placeholder="Tambah Kategori" wire:model="new_kategori" class="form-control" aria-describedby="btnsave">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" id="btnsave"> <i class="bx bx-save"></i> </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if ($pesan || $errors->any())
                            <div class="my-1">
                                <div class="alert alert-{{ ($pesan) ? 'success' : 'danger' }}">
                                    {{ ($pesan) ? $pesan : $errors->all()[0] }}    
                                </div>                        
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6 table-responsive pt-2">
                            <table class="table table-hover dt-responsive nowrap table-sm" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        
                                        <th class="align-middle">No</th>
                                        <th class="align-middle">Nama Kategori</th>
                                        <th class="align-middle">Jumlah Produk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $no = 1;
                                    @endphp
                                    @foreach($kategori as $k)
                                    <tr>
                                        
                                        <td>{{ $no++ }}</td>
                                        <td> {{ $k->nama_kategori }} </td>
                                        <td> @if($k->produk->count() != 0)  {{ $k->produk->count() }} Produk @else 
                                            <button onclick="hapus('{{ $k->id }}','{{ $k->nama_kategori }}')" class="btn btn-danger btn-sm"> <i class="bx bx-trash"></i> hapus </button> @endif</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 table-responsive pt-2">
                            <table class="table table-hover dt-responsive nowrap table-sm" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        
                                        <th class="align-middle">No</th>
                                        <th class="align-middle">Nama Lokasi</th>
                                        <th class="align-middle">Jumlah Produk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $no = 1;
                                    @endphp
                                    @foreach($lokasi as $l)
                                    <tr>
                                        
                                        <td>{{ $no++ }}</td>
                                        <td> {{ str(str()->title($l->nama_lokasi))->replace('_',' ')  }} </td>
                                        <td>  {{ $l->produk->count() }} Produk</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->