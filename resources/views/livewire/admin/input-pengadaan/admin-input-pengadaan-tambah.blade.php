@slot('title','Input pengadaan')
@slot('subtitle','Tambah Input')
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

                <h4 class="card-title">Data Produk</h4>
                <p class="card-title-desc">Lengkapi data sesuai produk</p>

                <form wire:submit.prevent="save">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="relative mb-3">
                                <label for="productname">Nama Produk / Barang</label>
                                <input id="productname" autocomplete="off"  wire:model.live="produk.nama_barang" name="productname" type="text" class="form-control">
                                @if (count($cari))                                    
                                    <div class="w-full bg-white border " style="width:100%;">
                                        @foreach ($cari as $c)
                                        <button type="button" wire:click="pilih({{ $c['id'] }})" class="w-full p-1 text-white border shadow btn btn-primary bg-primary" style="width:100%;">
                                            {{ $c['nama_barang'] }} ({{ $c['kategori']['nama_kategori'] }})
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
                                <label for="manufacturerbrand">Jumlah</label>
                                <input id="manufacturerbrand"  wire:model="codeproduk.jumlah_awal" name="manufacturerbrand" type="number" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="control-label">Lokasi Tujuan</label>
                                <select class="form-control select2" id="lokasi_tujuan" onmouseover="$(this).select2()" onchange="@this.set('codeproduk.lokasi_id', this.value)">
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
                                <textarea class="form-control"  wire:model="produk.keterangan" id="productdesc" rows="5"></textarea>
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