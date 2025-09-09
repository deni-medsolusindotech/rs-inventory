@slot('title','Data User')
@slot('icon','user-circle')
@push('style')
    <style>
        tr:hover {
        cursor: pointer;
        }
    </style>
@endpush
@push('script')
    <script>
   function terima(nama,id){
        Swal.fire({
            title: "Anda Yakin?",
            text: "Terima konfirmasi user "+nama+"?",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya, Terima!",
            cancelButtonText: "Tidak, Batal!",
            confirmButtonClass: "btn btn-primary mt-2",
            cancelButtonClass: "btn btn-secondary ms-2 mt-2",
            buttonsStyling: !1
        })
        .then(function (result) {
            if(result.isConfirmed){
               @this.konfirmasi(id,1);
            }
           
        })
     }
     function tolak(nama,id) {
        Swal.fire({
            title: "Anda yakin?",
            text: "Tolak konfirmasi user "+nama+"?",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya, Tolak",
            cancelButtonText: "Tidak, Batal",
            confirmButtonClass: "btn btn-danger mt-2",
            cancelButtonClass: "btn btn-secondary ms-2 mt-2",
            buttonsStyling: !1
        }).then((result) => {
            if (result.isConfirmed) {
                @this.konfirmasi(id,0)
            } else if (result.dismiss === Swal.DismissReason.cancel) {
            }
        });
    }
   function terimabanyak(selected){
        Swal.fire({
            title: "Anda Yakin?",
            text: "Terima konfirmasi "+selected+" user ?",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya, Terima!",
            cancelButtonText: "Tidak, Batal!",
            confirmButtonClass: "btn btn-primary mt-2",
            cancelButtonClass: "btn btn-secondary ms-2 mt-2",
            buttonsStyling: !1
        })
        .then(function (result) {
            if(result.isConfirmed){
               @this.konfirmasibanyak(1);
            }
           
        })
     }
     function tolakbanyak(selected) {
        Swal.fire({
            title: "Anda yakin?",
            text: "Tolak konfirmasi "+selected+" user ?",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya, Tolak",
            cancelButtonText: "Tidak, Batal",
            confirmButtonClass: "btn btn-danger mt-2",
            cancelButtonClass: "btn btn-secondary ms-2 mt-2",
            buttonsStyling: !1
        }).then((result) => {
            if (result.isConfirmed) {
                @this.konfirmasibanyak(0)
            } else if (result.dismiss === Swal.DismissReason.cancel) {
            }
        });
    }
    </script>
@endpush
<div>
   
    {{-- The whole world belongs to you. --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card rtc shadow-lg" style="min-height: 400px;">
                <div class="text-center mt-5"  wire:loading wire:target="konfirmasi,konfirmasibanyak">
                    <div class="spinner-border h1 text-primary m-1 my-auto" style="padding:50px;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-2 px-4" wire:loading.class="d-none" wire:target="konfirmasi,konfirmasibanyak">
                    @if ($selected)
                        
                    <button onclick="terimabanyak({{ count($selected) }})" type="button" class="btn btn-sm me-1 col-6 btn-primary"> <i class="bx bx-check-circle"></i> Terima</button>
                    <button onclick="tolakbanyak({{ count($selected) }})"  type="button" class="btn btn-sm me-1 col-6 btn-danger"> <i class="bx bx-x-circle"></i> Tolak</button>

                    @else

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
                                <option value="">Semua</option>
                                <option value="0" class="text-primary">Di Proses</option>
                                <option value="1"  class="text-danger">Di Tolak</option>
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
                    @endif

                </div>
                <div class="card-body"  wire:loading.class="d-none" wire:target="konfirmasi,konfirmasibanyak">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="text-center">Nama</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    
                                <tr class="@if(in_array($user->id,$selected)) table-secondary @endif">
                                    <td>
                                        <div class="d-flex">
                                            <div class="me-3">
                                                <input wire:model="selected" value="{{ $user->id }}" type="checkbox" id="{{ $user->id }}">
                                                <label for="{{ $user->id }}">
                                                    <img class="rounded-circle avatar-xs ms-1" src="/assets/{{ $user->avatar }}" alt="">
                                                </label>
                                            </div>
                                            <div>
                                                <h5 class="font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">{{ $user->name }}</a></h5>
                                                <p class="text-muted mb-0 small">{{ $user->status_medis }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div>
                                            <a href="javascript: void(0);" class="badge badge-soft-{{ ($user->confirm_at == null && $user->confirm == false) ? 'primary' : 'danger'; }} font-size-11 m-1">di {{ ($user->confirm_at == null && $user->confirm == false) ? 'proses' : 'tolak'; }}</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <button onclick="terima('{{ $user->name }}','{{ $user->id }}' )" type="button" class="btn btn-sm me-1 btn-primary"> <i class="bx bx-check-circle"></i> Terima</button>
                                            <button onclick="tolak('{{ $user->name }}','{{ $user->id }}')" type="button" class="btn btn-sm me-1 btn-danger"> <i class="bx bx-x-circle"></i> Tolak</button>
                                        </div>
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
