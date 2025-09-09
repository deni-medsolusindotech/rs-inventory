@slot('title','QRQODE ')
@slot('subtitle',$produk->produk->nama_barang.' - '. $produk->lokasi->nama_lokasi)
@slot('icon','detail')
@php
$tgl_kadaluarsa = ($produk->tgl_kadaluarsa) ? $produk->tgl_kadaluarsa->format('d F Y') : '-';
@endphp
<div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                @for($i = 0; $i < $jumlah; $i++)
                    <img id="qr{{ $i }}"  src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size($ukuran)->generate('Nama barang : '.$produk->produk->nama_barang .'  Lokasi : '.$produk->lokasi->nama_lokasi .' ,Tanggal Kadaluarsa : '.$tgl_kadaluarsa.' ,Tanggal pembelian : '.$produk->tgl_pembelian->format('d F Y') . ', Merk : '.$produk->produk->merk .' , Kategori : '.$produk->produk->kategori->nama_kategori .' , Jumlah Awal : '.$produk->jumlah_awal .' unit , Links : '.Request::url() .',')) !!} " class="m-3">
                @endfor
            </div>
            <div class="card-footer d-print-none d-flex justify-content-end">
                <div class="input-group ">
                    <select onchange="@this.set('jumlah',1)" wire:model="ukuran" name="" id="" class="form-control">
                        <option value="100">Ukuran Kecil</option>
                        <option value="150">Ukuran Sedang</option>
                        <option value="200">Ukuran Besar</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-info" wire:click="print()"> <i wire:loading class="bx bx-loader"></i> Jumlah</button>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-success" onclick="window.location.href='javascript:window.print()'"><i class="fa fa-print"></i> Print</button>
                    </div>
                </div>
            </div>
        </div>
         </div>
    
</div>
