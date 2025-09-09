@slot('title','Dashboard')
@push('style')
     <!-- tui charts Css -->
     <link href="/assets/libs/tui-chart/tui-chart.min.css" rel="stylesheet" type="text/css" />
@endpush

    <x-app-layout>
    <div class="row">
        <div class="col-md-5">
            <div class="overflow-hidden card">
                <div class="bg-success bg-soft">
                    <div class="row">
                        <div class="col-7">
                            <div class="p-3 text-dark">
                                <h5 class="text-dark">Selamat Datang !</h5>
                                <p>System Inventaris - Dashboard</p>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="pt-0 card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-4 avatar-md profile-user-wid">
                                <img src="/assets/{{ auth()->user()->avatar }}" alt="" class="img-thumbnail rounded-circle">
                            </div>
                            <h5 class="font-size-15 text-truncate ms-2">{{ str(auth()->user()->status_medis)->headline() }}</h5>
                        </div>

                        <div class="col-sm-8">
                            <div class="pt-4">

                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="font-size-15">{{ auth()->user()->name }}</h5>
                                        <p class="mb-1 text-muted">{{ auth()->user()->email }}</p>
                                        <p class="mb-0 text-muted">{{ auth()->user()->nomor_hp }}</p>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <a href="/profile/edit" class="btn btn-primary waves-effect waves-light btn-sm">Edit Profile <i class="mdi mdi-arrow-right ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @role(['admin','super_admin'])
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
                                            <h5 class="mb-0"><i class="bx bxs-layer"></i> {{ App\Models\pengajuankebutuhan::all()->count() }}</h5>
                                        </td>
                                        <td style="width: 25%">
                                            <h5 class="mb-0 text-info"><i class="bx bxs-time"></i> {{ App\Models\pengajuankebutuhan::whereHas('confirmation',function($query){$query->where('status','proses');})->count() }}</h5>
                                        </td>
                                        <td style="width: 25%">
                                            <h5 class="mb-0 text-success"><i class="bx bxs-check-circle"></i> {{ App\Models\pengajuankebutuhan::whereHas('confirmation',function($query){$query->where('status','terima');})->count() }}</h5>
                                        </td>
                                        <td style="width: 25%">
                                            <h5 class="mb-0 text-danger"><i class="bx bxs-x-circle"></i>{{ App\Models\pengajuankebutuhan::whereHas('confirmation',function($query){$query->where('status','tolak');})->count() }}</h5>
                                        </td>
                        
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="mb-0">Data Rencana belanja</p>
                                        </td>
                                        <td style="width: 25%">
                                            <h5 class="mb-0"><i class="bx bxs-layer"></i> {{ App\Models\codeproduk::where('status_rencana_belanja','!=',null)->count() }}</h5>
                                        </td>
                                        <td style="width: 25%">
                                            <h5 class="mb-0 text-info"> <i class="bx bxs-time"></i>  {{ App\Models\codeproduk::where('status_rencana_belanja','proses')->count() }}</h5>
                                        </td>
                                        <td style="width: 25%">
                                            <h5 class="mb-0 text-success"><i class="bx bxs-check-circle"></i>{{ App\Models\codeproduk::where('status_rencana_belanja','selesai')->count() }}</h5>
                                        </td>
                                        <td style="width: 25%">
                                            </td>
                                    
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="mb-0">Aproval Rusak / Hilang</p>
                                        </td>
                                        <td style="width: 25%">
                                            <h5 class="mb-0"><i class="bx bxs-layer"></i> {{ App\Models\pengajuankerusakan::all()->count() }}</h5>
                                        </td>
                                        <td style="width: 25%">
                                            <h5 class="mb-0 text-info"><i class="bx bxs-time"></i>  {{ App\Models\pengajuankerusakan::whereHas('confirmation',function($query){$query->where('status','proses');})->count() }}</h5>
                                        </td>
                                        <td style="width: 25%">
                                            <h5 class="mb-0 text-success"><i class="bx bxs-check-circle"></i> {{ App\Models\pengajuankerusakan::whereHas('confirmation',function($query){$query->where('status','terima');})->count() }}</h5>
                                        </td>
                                        <td style="width: 25%">
                                            <h5 class="mb-0 text-danger"><i class="bx bxs-x-circle"></i> {{ App\Models\pengajuankerusakan::whereHas('confirmation',function($query){$query->where('status','tolak');})->count() }}</h5>
                                        </td>
                                       
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endrole
       @include('dashboard-user')
       @include('dashboard-admin')

       
    </div>
    <!-- end row -->

   


</x-app-layout>
