<x-app-layout>
    @slot('title','Profile')
    @slot('icon','user-circle')
    @if (auth()->user()->status_user == 'done' || auth()->user()->status_user == 'konfirmasi')
        @livewire('data-user.user-detail',['email' => str(auth()->user()->email)->before('@')])
    @else
        @php $user = auth()->user() @endphp
        <div class="row">
            <div class="col-lg-12">
                <div class="card rtc ">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <img src="/assets/{{ $user->avatar }}" alt="" class="avatar-md rounded-circle img-thumbnail">
                            </div>
                            <div class="flex-grow-1 align-self-center">
                                <div class="text-muted">
                                    <h5>{{ $user->name }}</h5>
                                    <p class="mb-1">{{ $user->email }}</p>
                                    <p class="mb-0">{{ str($user->status_medis)->headline() }}</p>
                                </div>
                            </div>
                            <div class="">
                               @if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Super Admin')

                                @endif
                                @role(['medis','penunjang_laboratorium','penunjang_radiologi','penunjang_gizi'
                                ,'penunjang_cssd','penunjang_kamar_jenazah','penunjang_laundry','penunjang_sanitasi_limbah','farmasi','umum'])
                                    @if ($user->id == auth()->user()->id)
                                        <div class="flex-0">
                                            <a href="/profile/edit" class="btn btn-success btn-sm mb-1"> <i class="bx bx-edit"></i> Edit Profile</a>
                                        </div>
                                    @endif
                                @endrole
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      

    @endif

</x-app-layout>
