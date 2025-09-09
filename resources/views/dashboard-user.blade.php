@unlessrole(['admin', 'super_admin'])
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4 card-title">Data Konfirmasi</h4>
                <div class="mt-4 table-responsive">
                    <table class="table align-middle table-nowrap">
                        <tbody>
                            <tr>
                                <td style="width: 30%">
                                    <p class="mb-0">Aproval Pengajuan</p>
                                </td>
                                <td style="width: 25%">
                                    <h5 class="mb-0"><i class="bx bxs-layer"></i>
                                        {{ App\Models\pengajuankebutuhan::where('author', auth()->user()->id)->count() }}
                                    </h5>
                                </td>
                                <td style="width: 25%">
                                    <h5 class="mb-0 text-info"><i class="bx bxs-time"></i>
                                        {{ App\Models\pengajuankebutuhan::where('author', auth()->user()->id)->whereHas('confirmation', function ($query) {$query->where('status', 'proses');})->count() }}
                                    </h5>
                                </td>
                                <td style="width: 25%">
                                    <h5 class="mb-0 text-success"><i class="bx bxs-check-circle"></i>
                                        {{ App\Models\pengajuankebutuhan::where('author', auth()->user()->id)->whereHas('confirmation', function ($query) {$query->where('status', 'terima');})->count() }}
                                    </h5>
                                </td>
                                <td style="width: 25%">
                                    <h5 class="mb-0 text-danger"><i class="bx bxs-x-circle"></i>
                                        {{ App\Models\pengajuankebutuhan::where('author', auth()->user()->id)->whereHas('confirmation', function ($query) {$query->where('status', 'tolak');})->count() }}
                                    </h5>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <p class="mb-0">Data Rencana belanja</p>
                                </td>
                                <td style="width: 25%">
                                    <h5 class="mb-0"><i class="bx bxs-layer"></i>
                                        {{ App\Models\codeproduk::where('lokasi_id', auth()->user()->roles->first()->id)->where('status_rencana_belanja', '!=', null)->count() }}
                                    </h5>
                                </td>
                                <td style="width: 25%">
                                    <h5 class="mb-0 text-info"> <i class="bx bxs-time"></i>
                                        {{ App\Models\codeproduk::where('lokasi_id', auth()->user()->roles->first()->id)->where('status_rencana_belanja', 'proses')->count() }}
                                    </h5>
                                </td>
                                <td style="width: 25%">
                                    <h5 class="mb-0 text-success"><i class="bx bxs-check-circle"></i>
                                        {{ App\Models\codeproduk::where('lokasi_id', auth()->user()->roles->first()->id)->where('status_rencana_belanja', 'selesai')->count() }}
                                    </h5>
                                </td>
                                <td style="width: 25%">
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <p class="mb-0">Aproval Rusak / Hilang</p>
                                </td>
                                <td style="width: 25%">
                                    <h5 class="mb-0"><i class="bx bxs-layer"></i>
                                        {{ App\Models\pengajuankerusakan::where('author', auth()->user()->id)->count() }}
                                    </h5>
                                </td>
                                <td style="width: 25%">
                                    <h5 class="mb-0 text-info"><i class="bx bxs-time"></i>
                                        {{ App\Models\pengajuankerusakan::where('author', auth()->user()->id)->whereHas('confirmation', function ($query) {$query->where('status', 'proses');})->count() }}
                                    </h5>
                                </td>
                                <td style="width: 25%">
                                    <h5 class="mb-0 text-success"><i class="bx bxs-check-circle"></i>
                                        {{ App\Models\pengajuankerusakan::where('author', auth()->user()->id)->whereHas('confirmation', function ($query) {$query->where('status', 'terima');})->count() }}
                                    </h5>
                                </td>
                                <td style="width: 25%">
                                    <h5 class="mb-0 text-danger"><i class="bx bxs-x-circle"></i>
                                        {{ App\Models\pengajuankerusakan::where('author', auth()->user()->id)->whereHas('confirmation', function ($query) {$query->where('status', 'tolak');})->count() }}
                                    </h5>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @foreach ($role as $r)
            @if ($r->name == auth()->user()->roles->first()->name)
                <div class="card mini-stats-wid">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-muted fw-medium">({{ $r->users->count() }} User)</p>
                                <h4 class="mb-0"> {{ str(str()->title($r->name))->replace('_', ' ') }}</h4>
                                <h6 class="mb-0">Jumlah Jenis Produk :
                                    {{ App\Models\codeproduk::where('lokasi_id', $r->id)->count() }} Jenis </h6>
                                <h5>Jumlah : <span
                                        class="text-muted me-2"><del>{{ App\Models\codeproduk::where('lokasi_id', $r->id)->sum('jumlah_awal') }}
                                            Unit</del></span>
                                    <b>{{ App\Models\codeproduk::where('lokasi_id', $r->id)->sum('jumlah_akhir') }} Unit</b>
                                </h5>
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
@endunlessrole
