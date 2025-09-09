@slot('title','Hardcore')
@slot('subtitle','Edit')
@slot('icon','edit')
@push('script-bottom')
{{-- select2 --}}
<script src="/assets/libs/select2/js/select2.min.js"></script>
@endpush

@push('style')
{{-- select2 --}}

<link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
@endpush
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                @if ($pilihan)
                <div class="flex w-full flex-justify-between bg-secondary">
                    <div class="bg-danger" style="width:50%;">
                        <h4 class="card-title"> {{ $codeproduk->codeprodukid }} {{ $codeproduk->produk->nama_barang }} ( {{ $codeproduk->lokasi->nama_lokasi }} ) - Edit Data Produk</h4>
                        <p class="card-title-desc">merk : {{ $codeproduk->produk->merk }} - kategori : {{ $codeproduk->produk->kategori->nama_kategori }} - jumlah awal : {{ $codeproduk->jumlah_akhir }}</p>
                    </div>
                    <div style="width:50%;">
                        <button type="button" class="p-2 rounded-sm btn btn-danger"> <i class="bx bx-trash"></i> Hapus</button>
                    </div>
                </div>
                @else
                <h4 class="card-title">Edit Data Produk</h4>
                <p class="card-title-desc">Lengkapi data sesuai produk</p>                
                @endif

                <form wire:submit.prevent="save">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="relative mb-3">
                                <label for="productname">Nama Produk / Barang</label>
                                <input id="productname" autocomplete="off" placeholder="cari dengan nama_barang/merk/kodeproduk" wire:model.live="produk.nama_barang" name="productname" type="text" class="form-control">
                                @if (count($cari))                                    
                                    <div class="w-full bg-white border " style="width:100%;">
                                        @foreach ($cari as $c)
                                        <button type="button" wire:click="pilih({{ $c['id'] }})" class="w-full p-1 text-white border shadow btn btn-primary bg-primary" style="width:100%;">
                                            <b>{{ $c['codeprodukid'] }}</b> - {{ $c['produk']['nama_barang'] }} ({{ $c['lokasi']['nama_lokasi'] }}) - <i> {{ $c['produk']['merk'] }} </i> - <b> {{ $c['jumlah_akhir'] }} </b>
                                        </button><br/>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label class="control-label">Kategori</label>
                                <select class="form-control select2" id="kategori" onmouseover="$(this).select2()" onchange="@this.set('produk.kategori_id', this.value)">
                                    <option>Pilih Kategori</option>
                                    @foreach ($allkategori as $kategori)
                                        <option @if($produk->kategori_id == $kategori->id) selected @endif value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="manufacturername">Merk</label>
                                <input id="manufacturername"  wire:model="produk.merk" name="manufacturername" type="text" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_awal">Jumlah Awal</label>
                                <input id="jumlah_awal"  wire:model="codeproduk.jumlah_awal"  type="number" class="form-control">
                            </div>
                            
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="control-label">Lokasi </label>
                                <select class="form-control select2" disabled id="lokasi_tujuan" onmouseover="$(this).select2()" onchange="@this.set('codeproduk.lokasi_id', this.value)">
                                    <option>Pilih Lokasi</option>
                                    @foreach ($alllokasi as $lokasi)
                                        <option @if($codeproduk->lokasi_id == $lokasi->id) @php $this->nama_lokasi = $lokasi->nama_lokasi; @endphp selected @endif value="{{ $lokasi->id }}">{{ $lokasi->nama_lokasi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="manufacturerbrand">Rencana Tanggal Pembelian</label>
                                <input id="manufacturerbrand"  wire:model="codeproduk.tgl_pembelian" name="manufacturerbrand" type="date" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="productdesc">Keterangan</label>
                                <textarea class="form-control"  wire:model="produk.keterangan" id="productdesc" rows="9"></textarea>
                            </div>
                            
                        </div>
                    </div>
                    @if ($errors->any())
                        <div class="mx-4 alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary waves-effect waves-light"><i class="bx bx-save"></i> Simpan Produk</button>
                        <a href="/input-pengadaan" class="btn btn-secondary waves-effect waves-light ms-1"><i class="bx bx-x"></i> batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- end row -->