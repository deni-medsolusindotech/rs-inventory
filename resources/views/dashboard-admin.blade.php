@role(['admin','super_admin'])
<div class="row">
    @foreach ($role as $r)
    @if ($r->name != 'super_admin' && $r->name != 'admin')
        
        <div class="col-lg-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">({{ $r->users->count() }} User)</p>
                            <h4 class="mb-0"> {{ str(str()->title($r->name))->replace('_',' ') }}</h4>
                            <h6 class="mb-0">Jumlah Jenis Produk : {{ App\Models\codeproduk::where('lokasi_id',$r->id)->count()}} Jenis </h6>
                            <h5>Jumlah : <span class="text-muted me-2"><del>{{ App\Models\codeproduk::where('lokasi_id',$r->id)->sum('jumlah_awal')}} Unit</del></span>
                                <b>{{ App\Models\codeproduk::where('lokasi_id',$r->id)->sum('jumlah_akhir')}} Unit</b></h5>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                <span class="avatar-title">
                                    <i class="bx bx-copy-alt font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
    @endif

@endforeach
</div>
@endrole