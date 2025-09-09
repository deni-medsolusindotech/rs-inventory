@slot('title','Riwayat Penjelajahan')
@slot('icon','history')
@push('script-bottom')
{{-- select2 --}}
<script src="/assets/libs/select2/js/select2.min.js"></script>
@endpush

@push('style')
{{-- select2 --}}

<link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
@endpush
@role(['admin','super_admin'])
@push('body')
data-keep-enlarged="true" class="vertical-collpsed"
@endpush
@endrole
<div class="row">
    @if (!$semua)        
        <div class="card col-md-12">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <div class="search-box d-inline-block mx-auto ">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search..." wire:model="search">
                                <i class="bx bx-search-alt search-icon"></i>
                            </div>
                        </div>
                    </div>
                    @role(['super_admin','admin'])    
                        <div class="mx-0 px-0 ">
                            <div class="position-relative">
                                @if ($semua)
                                    <button class="btn btn-primary" wire:click="$set('semua',0)"><i class="bx bx-user"></i> Riwayat {{ auth()->user()->name }}</button>
                                @else
                                    <button class="btn btn-primary" wire:click="$set('semua',1)"><i class="bx bx-detail"></i> Semua Riwayat User</button>
                                @endif
                            </div>
                        </div>
                    @endrole
                    <div class="mx-0 px-0 ">
                        <div class="position-relative">
                            <input type="date" class="form-control" placeholder="Search..." wire:model="date_filter">
                        </div>
                    </div>
                </div>
                <hr>
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Riwayat</th>
                        <th>Tanggal</th>
                    </tr>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($log as $riwayat)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ str($riwayat->keterangan)->title() }}</td>
                            <td>{{ $riwayat->created_at->format('d F Y') }} <i class="text-muted">{{ $riwayat->created_at->diffForHumans() }}</i></td>
                        </tr>
                    @endforeach
                </table>
                {{ $log->links() }}
            </div>
        </div>
    @else   
    @role(['super_admin','admin'])    
        <div class="card col-md-12">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <div class="search-box d-inline-block mx-auto ">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search..." wire:model="search">
                                <i class="bx bx-search-alt search-icon"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mx-0 px-0 ">
                        <div class="position-relative">
                            <input type="date" class="form-control" placeholder="Search..." wire:model="date_filter">
                        </div>
                    </div>
                </div>
                <div class="d-flex  justify-content-between mt-3">
                    <div class="mx-0 px-0 ">
                        <div class="position-relative">
                            <select style="width:300px;" class="form-control select2" onmouseover="$(this).select2()" onchange="@this.set('auth_filter', this.value)" id="lokasi"  style="width:100%" >
                                <option value="" @if($auth_filter == null) selected @endif> Semua Authentication </option>
                                @foreach($auth as $a)
                                    <option value="{{ $a->id }}" @if($auth_filter == $a->id) selected @endif> {{ str(str()->title($a->name))->replace('_',' ')  }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mx-0 px-0 ">
                        <div class="position-relative">
                            <button class="btn btn-info" wire:click="$set('semua',0)"><i class="bx bx-user"></i> Riwayat {{ auth()->user()->name }}</button>
                        </div>
                    </div>
                    <div class="mx-0 px-0 ">
                        <div class="position-relative">
                            <select style="width:300px;" class="form-control select2" onmouseover="$(this).select2()" onchange="@this.set('user_filter', this.value);console.log(this.value)" id="kategori"  style="width:100%" >
                                <option value="" @if($user_filter == null) selected @endif> Semua User </option>
                                @foreach($users as $u)
                                    <option value="{{ $u->id }}" @if($user_filter == $u->id) selected @endif> {{ $u->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th> User</th>
                        <th>Riwayat</th>
                        <th>Tanggal</th>
                    </tr>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($log_all as $riwayat)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $riwayat->user->name }} ({{ $riwayat->user->roles->first()->name  }}) <br> {{ $riwayat->user->nomor_hp }}</td>
                            {{-- <td>{{ $riwayat->user }} {{ $riwayat->user->role->name  }} <br> {{ $riwayat->user->nomor_hp }}</td> --}}
                            <td>{{ str($riwayat->keterangan)->title() }}</td>
                            <td>{{ $riwayat->created_at->format('d F Y') }} <i class="text-muted">{{ $riwayat->created_at->diffForHumans() }}</i></td>
                        </tr>
                    @endforeach
                </table>
                {{ $log_all->links() }}
            </div>
        </div>
    @endrole
    @endif
    
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
</div>
