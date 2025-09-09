@slot('title','Data User')
@slot('icon','user-circle')
@push('style')
    <style>
        tr:hover {
        cursor: pointer;
        }
    </style>
@endpush
<div>
    {{-- The whole world belongs to you. --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card rtc shadow-lg" style="min-height: 400px;">
                <div class="d-flex justify-content-between mt-2 px-4">
                    <div class="d-flex">
                        <div class="me-2" style="min-width:50px;">
                            <select class="form-control" wire:model="row">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        
                        <div class="input-group" style="min-width:300px;">
                            <button type="submit" class="btn btn-success"><i class="bx bx-filter"></i> </button>
                            <select class="form-control" wire:model="status">
                                <option value="">Semua Konfirmasi</option>
                                <option value="proses" class="text-primary">Di Proses</option>
                                <option value="terima" class="text-success">Di Terima</option>
                                <option value="tolak"  class="text-danger">Di Tolak</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4" >
                        <form wire:submit.prevent="search">
                            <div class="input-group">
                                <input wire:model.defer="search" type="text" class="form-control" placeholder="Cari User...">
                                <button type="submit" class="btn btn-success"><i class="bx bx-search"></i> </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 70px;">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    
                                <tr @if ($user->role !== 'Admin') onclick="Turbolinks.visit('/data-user/{{ str($user->email)->before('@') }}/detail');"
                                    @elseif ($user->id == auth()->user()->id) onclick="Turbolinks.visit('/profile');" @endif> 
                                    <td>
                                        <div>
                                            <img class="rounded-circle avatar-xs" src="/assets/{{ $user->avatar }}" alt="">
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class="font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">{{ $user->name }}</a></h5>
                                        <p class="text-muted mb-0 small">{{ str($user->status_medis)->headline() }}</p>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div>
                                            <a href="javascript: void(0);" class="badge badge-soft-primary font-size-11 m-1">di {{ $user->statusKonfirmasi->status ?? 'proses' }}</a>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($user->role !== 'Admin' || $user->id == auth()->user()->id) 
                                        <ul class="list-inline font-size-20 contact-links mb-0">
                                            <li class="list-inline-item px-2">
                                                <i class="bx bx-user-circle"></i>
                                            </li>
                                        </ul>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <h4 class="p-5 m-5">
                                            Tidak ada user
                                        </h4>
                                    </td>
                                </tr>
                                @endforelse
                             
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                       {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

</div>
