@slot('title','Log Book Perawat')
@slot('icon','book')
@push('body')
data-keep-enlarged="true" class="vertical-collpsed"
@endpush
@push('style')
    <style>
        tr:hover {
        cursor: pointer;
        }
    </style>
       <!-- DataTables -->
       <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
       <link href="/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

       <!-- Responsive datatable examples -->
       <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />     
@endpush
@push('script')
       <!-- Required datatable js -->
       <script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
       <script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
       
       <!-- Responsive examples -->
       <script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
       <script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
       <script src="/assets/js/custom/datatable.init.js"></script>

@endpush


<div>
    <x-status-verifikasi></x-status-verifikasi>
    {{-- The whole world belongs to you. --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card rtc shadow-lg" style="min-height: 400px;">
                <div class="d-flex justify-content-between mt-2 px-4">
                    <div class="d-flex">
                        <div id="customShowEntries" style="width:60px; padding-right:10px;">
                            <select id="showEntriesSelect" class="form-control">
                              <option value="5">5</option>
                              <option value="10" selected>10</option>
                              <option value="25">25</option>
                              <option value="50">50</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <input type="text" id="customSearch" class="form-control" placeholder="Cari Logbook...">
                            <button type="button" class="btn btn-success"><i class="bx bx-search"></i> </button>
                        </div>
                        
                    </div>
                    <div class="col-md-4" >
                        <div class="float-end">
                            <a href="/log-book/input" class="btn btn-primary"> <i class="bx bxs-comment-add"></i> Isi Logbook Hari Ini</a>
                            <a href="/log-book/laporan" class="btn btn-success"> <i class="bx bx-file"></i> Laporan</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table  id="myTable" class="table nowrap w-100">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 10px;">No</th>
                                    <th scope="col">Nama Kegiatan</th>
                                    <th scope="col">Nomor RM</th>
                                    <th scope="col">Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($logbooks as  $index => $logbook)
                                        <tr @if (now()->format('d-m-y') == $logbook->created_at->format('d-m-y')) class="table-info" onclick="Turbolinks.visit('/log-book/input')" @endif> 
                                            <td style="width: 10px;">
                                            {{$no++}}
                                            </td>
                                            <td style=" word-wrap: break-word;white-space: normal;">
                                            <p class="mb-0 ">{{ $logbook->kegiatan->isi }}   
                                                 {{-- @if($logbook->jumlah_kegiatan >= 2)
                                                    <span class="badge badge-pill badge-soft-success font-size-11">Jumlah Kegiatan : {{ $logbook->jumlah_kegiatan }}</span>
                                                @endif --}}
                                            </p>
                                            </td>
                                            
                                            <td>
                                               {{ $logbook->no_rm }}
                                            </td>
                                            <td>
                                                <p class="text-muted mb-0 ">{{ $logbook->waktu }}</p>
                                            </td>
                                        </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <h3 class="p-5 m-5">
                                            Tidak Ada Logbook...
                                        </h3>
                                    </td>
                                </tr>
                                @endforelse
                             
                            </tbody>
                        </table>
                        <p id="custom-bottom" class="p-0 m-0" > <span id="customInfo"></span> <span id="customPagination"></span></p>
                    </div>
                    <div class="d-flex justify-content-center">
                       {{-- {{ $users->links() }} --}}
                    </div>
                </div>
                <div class="card-footer">
                    
                </div>
            </div>
        </div>
    </div>
</div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

</div>
