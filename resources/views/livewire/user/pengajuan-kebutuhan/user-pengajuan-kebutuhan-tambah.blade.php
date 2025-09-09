<div>
    
@slot('title','Pengajuan Kebutuhan')
@slot('subtitle','Buat Pengajuan Kebutuhan')
@slot('icon','upload')

@push('script-bottom')
    {{-- select2 --}}
    <script src="/assets/libs/select2/js/select2.min.js"></script>
    <script src="/assets/js/pages/form-advanced.init.js"></script>
@endpush

@push('style')
    {{-- select2 --}}
    <link href="assets/libs/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet" type="text/css" />
  
@endpush

<!-- end row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-title">
                        <h4 class="float-end font-size-16"># Pengajuan Kebutuhan</h4>
                        <div class="mb-1">
                            <img src="/image/logo.png" alt="logo" height="50"/>
                        </div>
                        <hr>
                    </div>
                    <div class="col-md-12 text-sm-end">
                        <address class="mt-2 mt-sm-0">
                            {{ $now }}<br>
                            {{ auth()->user()->name }} ({{ auth()->user()->getRoleNames()->first() }})<br>
                        <i> {{ auth()->user()->nomor_hp }} </i>
                        </address>
                    </div>
                    <div class="row">
                        <div class="col-md-5 mb-2 ps-5">
                            Nama Barang
                        </div>
                        <div class="col-md-7 mb-2">
                            @if ($data['nama_barang'])
                            <form wire:submit.prevent="$set('data.nama_barang',0)">
                                <div class="input-group">
                                    <input wire:model="pengajuan.nama_barang" type="text" class="form-control" placeholder="Nama barang">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"> <i class="bx bx-save"></i> </button>
                                    </div>
                                </div>
                            </form>
                            @else
                                <u wire:click="$set('data.nama_barang',1)" data-turbolinks="false">{{ ($pengajuan->nama_barang) ? $pengajuan->nama_barang : 'Nama barang' }}</u>
                            @endif
                        </div>
                        <div class="px-5">
                            <hr>
                        </div>
                        <div class="col-md-5 mb-2 ps-5">
                            Jenis / Kategori
                        </div>
                        <div class="col-md-7 mb-2">
                            @if ($data['jenis'])
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
                            @endif
                        </div>
                        <div class="px-5">
                            <hr>
                        </div>
                        <div class="col-md-5 mb-2 ps-5">
                            Jumlah
                        </div>
                        <div class="col-md-7 mb-2">
                            @if ($data['jumlah'])
                            <form wire:submit.prevent="$set('data.jumlah',0)" >
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <button class="btn btn-danger" wire:click="number('kurang')" type="button"> - </button>
                                    </div>
                                    <input wire:model="pengajuan.jumlah" type="number" class="form-control" placeholder="Input Jumlah">
                                    <div class="input-group-append">
                                        <button class="btn btn-success" wire:click="number('tambah')" type="button"> + </button>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"> <i class="bx bx-save"></i> </button>
                                    </div>
                                </div>
                            </form>
                            @else
                                <u wire:click="$set('data.jumlah',1)" data-turbolinks="false">{{ ($pengajuan->jumlah) ? $pengajuan->jumlah.' unit' : 'Jumlah Barang' }}</u>
                            @endif
                        </div>
                        <div class="px-5">
                            <hr>
                        </div>
                        <div class="col-md-5 mb-2 ps-5">
                            Deskripsi
                        </div>
                        <div class="col-md-7 mb-2">
                            @if ($data['deskripsi'])
                            <form wire:submit.prevent="$set('data.deskripsi',0)" class="row">
                                <textarea class="form-control" wire:model="pengajuan.deskripsi"  wire:keydown.enter="$set('data.deskripsi',0)" style="max-width: 500px;min-width: 420px;" cols="50" rows="10"></textarea>
                                <div class="mt-1 mx-0 p-0">
                                    <button class="btn btn-primary btn-sm" type="submit"> <i class="bx bx-save"></i> simpan deskripsi </button>
                                </div>
            
                            </form>
                            @else
                                <u wire:click="$set('data.deskripsi',1)" data-turbolinks="false">{{ ($pengajuan->deskripsi) ? $pengajuan->deskripsi : 'deskripsi' }}</u>
                            @endif
                        </div>
                        <div class="px-5">
                            <hr>
                        </div>
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
                        <div class="d-print-none">
                            <div class="d-flex justify-content-center pt-3">
                                <a href="javascript: void(0);" wire:click="buatpengajuan" class="btn btn-primary w-md waves-effect waves-light  me-1"><i class="bx bx-save"></i> Buat Pengajuan</a>
                                <a href="/pengajuan-kebutuhan" class="btn btn-secondary waves-effect waves-light "><i class="bx bx-x"></i> batal</a>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>


</div>