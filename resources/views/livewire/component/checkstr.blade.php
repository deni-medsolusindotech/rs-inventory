<div>
    @if (auth()->user()->str)
        
    <div class="card shadow-xl" style="min-height:300px">
        <div class="card-body ">
            <div class="col-md-11">
                <div class="card-header bg-info bg-soft">
                    <h4 class="card-title mb-4 col-md-11">Surat Tanda Registrasi</h4>
                </div>
            <hr>
                <div class="row">
                    <h5>{{ $str->tanggal->format('d F Y') }} - {{ $str->tanggal_kadaluarsa->format('d F Y') }}</h5>
                    <p class="text-secondary"> {{ $str->waktu  }}</p>
                    <div class="mt-4">
                        @if($this->str->cek)
                        <a href="/spk-pengajuan/form-kredensial" class="btn btn-primary waves-effect waves-light btn-sm">SPK Pengajuan <i class="mdi mdi-arrow-right ms-1"></i></a>
                        @else
                        <a href="/spk-pengajuan/form-kredensial" class="btn btn-danger waves-effect waves-light btn-sm">Perpanjang STR <i class="mdi mdi-arrow-right ms-1"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
