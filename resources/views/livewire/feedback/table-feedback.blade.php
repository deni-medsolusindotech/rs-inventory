@slot('title','Feedback')
@slot('icon','chat')
@push('style')
<link rel="stylesheet" type="text/css" href="/assets/libs/toastr/build/toastr.min.css">
@endpush
@push('script')
<script src="/assets/libs/toastr/build/toastr.min.js"></script> 
<script>
    Livewire.on('errors',function(){
        toastr["warning"]("Isian Feedback Tidak lengkap , Tolong Lengkapi Untuk mengirim Feedback", "Error")
    })
    
        toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": 300,
        "hideDuration": 1000,
        "timeOut": 8000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }       
</script>
@endpush
<div>
    <div class="col-12">
        <!-- Left sidebar -->
        <div class="shadow-lg email-leftbar card ">
            <button wire:click="$set('page','baru')" class="btn btn-success btn-block waves-effect waves-light" >
              <i class="bx bx-edit-alt"></i>  Tulis Feedback
            </button>
            <div class="mt-4 mail-list">
                <a href="javascript: void(0);" wire:click="$set('page','kontak-masuk')" class="@if($page == 'kontak-masuk') active @endif"><i class="mdi mdi-email-outline me-2"></i> Feedback Masuk <span class="ms-1 float-end">{{ $kontakMasuk->count() }}</span></a>
                <a href="javascript: void(0);" wire:click="$set('page','kontak-terkirim')" class="@if($page == 'kontak-terkirim') active @endif"><i class="mdi mdi-email-check-outline me-2"></i>Feedback Terkirim <span class="ms-1 float-end">{{ $terkirim->count() }}</a>
                <a href="javascript: void(0);" wire:click="$set('page','notifikasi')" class= "@if($page == 'notifikasi') active @endif"><i class="mdi mdi-email-outline me-2"></i> Notifikasi <span class="ms-1 float-end">{{ $notifikasi->count() }}</span></a>
                <a href="javascript: void(0);" wire:click="$set('page','trash')" class= "@if($page == 'trash') active @endif"><i class="far fa-trash-alt me-2"></i> Trash <span class="ms-1 float-end">{{ $trash->count() }}</span></a>
            </div>
        </div>
       
        <div class="mb-3 email-rightbar" >
            
            <div class="shadow-lg card" style="min-height: 400px;">
                @if ($page != 'baru')

                <div class="p-3 btn-toolbar" role="toolbar">
                    <div class="mb-2 btn-group me-2 mb-sm-0">
                        {{-- <button type="button" wire:click="bulkDelete" class="btn btn-primary waves-light waves-effect"><i class="far fa-trash-alt"></i> </button> --}}
                        <button type="button" wire:click="bulkRead" class="btn btn-primary waves-light waves-effect"><i class="mdi mdi-eye"></i> </button>
                    </div>

                    <form wire:submit.prevent="search">
                    <div class="mb-2 btn-group me-2 mb-sm-0">
                            <input type="text" wire:model.defer="keySearch" class="form-control" placeholder="Cari Feedback..." name="" id="">
                            <button type="submit" class="btn btn-primary waves-light waves-effect ">
                            <i class="mdi mdi-email-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                @endif
                @if ($page == 'baru')
                <div class="card-header">
                    <h5 class="card-title" id="composecardTitle">Feedback Baru</h5>
                </div>
                <div class="card-body">
                    <div>
                        @if ($newFeedbackToUser)
                            <div class="mb-3">
                                <div class="mb-4 d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <img class="rounded-circle avatar-sm" src="/assets/{{ $newFeedbackToUser->avatar }}" alt="profile">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mt-1 font-size-14">{{ $newFeedbackToUser->name }}</h5>
                                            <small class="text-muted">{{ $newFeedbackToUser->email }}</small>
                                        </div>
                                </div>
                            </div>
                        @endif
                        <div class="mb-3">
                            <select class="form-control" wire:model="newFeedback.to">
                                <option value="" hidden>Pilih Tujuan Feedback</option>
                                @foreach ($users as $user)
                                 <option value="{{ $user->id }}">{{ $user->email }}</option>
                                @endforeach
                            </select>    
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="10" wire:model.defer="newFeedback.message"></textarea>
                        </div>

                    </div>
                </div>
                <div class="text-center card-footer">
                    <button type="button" wire:click="sendFeedback" class="btn btn-primary">Kirim Feedback <i class="fab fa-telegram-plane ms-1"></i></button>
                    <a href="/feedback" class="btn btn-secondary">Batal</a>
                </div>
                @elseif($messageid)
                    @if ($page == 'notifikasi')
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-xs ">
                                        <span class="avatar-title bg-{{ $feedback->color }} rounded-circle font-size-16">
                                            <i class="{{ $feedback->icon }}"></i>
                                        </span>
                                    </div>     
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mt-1 font-size-14">{{ $feedback->judul }}</h5>
                                    <small class="text-muted">{{ $feedback->waktu }}</small>
                                </div>
                            </div>
                            <hr/>
                            {{-- <h4 class="font-size-16">{{ $feedback->subject }}</h4> --}}
                            <p class="px-2">
                                {!! nl2br($feedback->pesan) !!}
                            </p>
                            <br>
                            <a href="{{ $feedback->link }}" class="mt-4 btn btn-primary waves-effect" ><i class="mdi mdi-reply"></i> Kunjungi halaman </a>
                        </div>
                    @else
                        @foreach ($feedbackRead as $item)
                            @if ($item->id == $messageid)
                                
                            <div class="card-body">
                                <div class="d-flex">
                                    @if ($page == 'kontak-masuk')
                                        <div class="flex-shrink-0 me-3">
                                            <img class="rounded-circle avatar-sm" src="/assets/{{ $feedback->dari->avatar }}" alt="profile">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mt-1 font-size-14">{{ $feedback->dari->name }}</h5>
                                            <small class="text-muted">{{ $feedback->dari->email }}</small>
                                        </div>
                                    @elseif($page == 'kontak-terkirim')
                                        <div class="flex-shrink-0 me-3">
                                            <img class="rounded-circle avatar-sm" src="/assets/{{ $feedback->tujuan->avatar }}" alt="profile">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="mt-1 font-size-14">{{ $feedback->tujuan->name }}</h5>
                                            <small class="text-muted">{{ $feedback->tujuan->email }}</small>
                                        </div>
                                    @endif
                                    <div class="date float-end text-muted">
                                        {{ $feedback->waktu_dua }}
                                    </div>
                                </div>
                                <hr/>
                                {{-- <h4 class="font-size-16">{{ $feedback->subject }}</h4> --}}
                                <p class="px-2">
                                    {!! nl2br($feedback->message) !!}
                                </p>
                                @if ($page == 'kontak-masuk')
                                    <br>
                                    <a href="javascript: void(0);" class="mt-4 btn btn-secondary waves-effect" wire:click="replyFeedback({{ $feedback->from }})"><i class="mdi mdi-reply"></i> Balas Feedback</a>
                                @endif
                            </div>
                            @else
                            @php if($item->to == auth()->user()->id){ $masuk = true;}else{$masuk = false;} @endphp          
                                <div class="">
                                    <ul class="message-list mb-n1">
                                        <li @if ($masuk) @if (!$item->readTo)  class="unread" @endif @else @if (!$item->readFrom) class="unread" @endif @endif>
                                            <div class="text-center col-mail col-mail-1">
                                                @if($masuk)
                                                <a href="/feedback/?page=@if($masuk) kontak-masuk @else kontak-terkirim @endif&&messageid={{ $item->id }}" class="text-decoration-none">
                                                    <div class="row ps-3">
                                                        <div class="col-1">
                                                            <img class="rounded-circle header-profile-user" src="/assets/{{ $item->dari->avatar }}" alt="Header Avatar">
                                                        </div>
                                                        <div class="col-6 pe-1">
                                                            <p class="text-right small ">{{ $item->dari->email }}</p>
                                                        </div>
                                                        <div class="col-4">
                                                            <span class="m-0 bg-info badge"> Diterima   </span>
                                                        </div>
                                                    </div>
                                                </a>
                                                @else
                                                <a href="/feedback/?page=@if($masuk) kontak-masuk @else kontak-terkirim @endif&&messageid={{ $item->id }}" class="text-decoration-none">
                                                    <div class="row ps-3">
                                                        <div class="col-1">
                                                            <img class="rounded-circle header-profile-user" src="/assets/{{ $item->tujuan->avatar }}" alt="Header Avatar">
                                                        </div>
                                                        <div class="col-6 pe-1">
                                                            <p class="text-right small ">{{ $item->tujuan->email }}</p>
                                                        </div>
                                                        <div class="col-4">
                                                            <span class="m-0 bg-primary badge"> Terkirim   </span>
                                                        </div>
                                                    </div>
                                                </a>
                                                @endif
                                            </div>
                                            <div class="col-mail col-mail-2">
                                                <a href="/feedback/?page=@if($masuk) kontak-masuk @else kontak-terkirim @endif&&messageid={{ $item->id }}" class="subject">
                                            <span class="teaser">{{ $item->message }}.</span> 
                                                </a>
                                            <div class="date">{{ $item->waktu }}</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            @endif

                        @endforeach
                    @endif
                       


                @elseif($page == 'notifikasi')
                
                <ul class="message-list">
                    @forelse ($notifikasi as $notif)      
                    @php if($notif->to == auth()->user()->id){ $masuk = true;}else{$masuk = false;} @endphp          
                    <li @if (!$notif->read)  class="unread" @endif >
                        <div class="col-mail col-mail-1">
                            <div class="d-flex">
                                {{-- <div class="checkbox-wrapper-mail">
                                    <input type="checkbox" id="{{ $notif->id }}">
                                    <label for="{{ $notif->id }}" class="toggle"></label>
                                </div> --}}
                                <a href="/feedback/?page=notifikasi&&messageid={{ $notif->id }}" class="title">{{ $notif->judul }}</a>
                                <div class="mt-2 avatar-xs ms-5">
                                    <span class="avatar-title bg-{{ $notif->color }} rounded-circle font-size-16">
                                        <i class="{{ $notif->icon }}"></i>
                                    </span>
                                </div>
                            </div>
                            {{-- <img class="rounded-circle header-profile-user" src="/assets/{{ auth()->user()->avatar }}" alt="Header Avatar"> --}}
                            
                        </div>
                        <div class="col-mail col-mail-2">
                            <a href="/feedback/?page=notifikasi&&messageid={{ $notif->id }}" class="subject"><span class="bg-info badge me-2">notifikasi</span><span class="teaser">{{ $notif->pesan }}.</span>
                            </a>
                            <div class="date">{{ $notif->waktu_dua }}</div>
                        </div>
                    </li>
                    @empty
                    <li  style="height:120px">
                        <div class="my-auto text-center">
                            <h4 class="mt-5" >Tidak ada notifikasi</h4>
                        </div>
                    </li>
                    @endforelse
                    .
                </ul>
                @elseif($page == 'kontak-masuk')
                <ul class="message-list">
                    @forelse ($kontakMasuk as $feedbackMasuk)  
                    @php if($feedbackMasuk->to == auth()->user()->id){ $masuk = true;}else{$masuk = false;} @endphp          
                    <li @if ($masuk) @if (!$feedbackMasuk->readTo)  class="unread" @endif @else @if (!$feedbackMasuk->readFrom) class="unread" @endif @endif>
                        <div class="col-mail col-mail-1">
                            <div class="checkbox-wrapper-mail">
                                <input wire:model="selectedBulk" value="{{ $feedbackMasuk->id }}" type="checkbox" id="{{ $feedbackMasuk }}">
                                <label for="{{ $feedbackMasuk }}" class="toggle"></label>
                            </div>
                            <a href="/feedback/?page=kontak-masuk&&messageid={{ $feedbackMasuk->id }}" class="title">{{ $feedbackMasuk->dari->email }}</a>
                            <img class="rounded-circle header-profile-user" src="/assets/{{ $feedbackMasuk->dari->avatar }}" alt="Header Avatar">

                        </div>
                        <div class="col-mail col-mail-2">
                            <a href="/feedback/?page=kontak-masuk&&messageid={{ $feedbackMasuk->id }}" class="subject"><span class="bg-info badge me-2">{{ $feedbackMasuk->subject }}</span><span class="teaser">{{ $feedbackMasuk->message }}.</span>
                            </a>
                            <div class="date">{{ $feedbackMasuk->waktu }}</div>
                        </div>
                    </li>
                    @empty
                    <li  style="height:120px">
                        <div class="my-auto text-center">
                            <h4 class="mt-5" >Tidak ada kontak masuk</h4>
                        </div>
                    </li>
                    @endforelse
                    .
                </ul>
                @elseif($page == 'kontak-terkirim')
                <ul class="message-list">
                    @forelse ($terkirim as $feedbackTerkirim)     
                    @php if($feedbackTerkirim->to == auth()->user()->id){ $masuk = true;}else{$masuk = false;} @endphp                     
                    <li @if ($masuk) @if (!$feedbackTerkirim->readTo)  class="unread" @endif @else @if (!$feedbackTerkirim->readFrom) class="unread" @endif @endif>
                        <div class="col-mail col-mail-1">
                            <div class="checkbox-wrapper-mail">
                                <input type="checkbox" wire:model="selectedBulk" value="{{ $feedbackTerkirim->id }}" id="{{ $feedbackTerkirim->id }}">
                                <label for="{{ $feedbackTerkirim->id }}" class="toggle"></label>
                            </div>
                            <a href="/feedback/?page=kontak-terkirim&&messageid={{ $feedbackTerkirim->id }}" class="title">{{ $feedbackTerkirim->tujuan->email }}</a>
                            <img class="rounded-circle header-profile-user" src="/assets/{{ $feedbackTerkirim->tujuan->avatar }}" alt="Header Avatar">
                            
                        </div>
                        <div class="col-mail col-mail-2">
                            <a href="/feedback/?page=kontak-terkirim&&messageid={{ $feedbackTerkirim->id }}" class="subject"><span class="bg-info badge me-2">{{ $feedbackTerkirim->subject }}</span><span class="teaser">{{ $feedbackTerkirim->message }}.</span>
                            </a>
                            <div class="date">{{ $feedbackTerkirim->waktu }}</div>
                        </div>
                    </li>
                    @empty
                    <li  style="height:120px">
                        <div class="my-auto text-center">
                            <h4 class="mt-5" >Tidak ada kontak terkirim</h4>
                        </div>
                    </li>
                    @endforelse
                    .
                </ul>
                @elseif($page == 'trash')
                <ul class="message-list">
                    @forelse ($trash as $feedbackTrash)     
                    @php if($feedbackTrash->to == auth()->user()->id){ $masuk = true;}else{$masuk = false;} @endphp                     
                    <li @if ($masuk) @if (!$feedbackTrash->readTo)  class="unread" @endif @else @if (!$feedbackTrash->readFrom) class="unread" @endif @endif>
                        <div class="col-mail col-mail-1 ps-4">
                            <a href="/feedback/?page=kontak-terkirim&&messageid={{ $feedbackTrash->id }}" class="title">{{ $feedbackTrash->tujuan->email }}</a>
                            <img class="rounded-circle header-profile-user" src="/assets/{{ $feedbackTrash->tujuan->avatar }}" alt="Header Avatar">
                            
                        </div>
                        <div class="col-mail col-mail-2">
                            <a href="/feedback/?page=kontak-terkirim&&messageid={{ $feedbackTrash->id }}" class="subject"> @if($masuk) <span class="bg-info badge me-2">Feedback Masuk</span> @else <span class="bg-primary badge me-2">Feedback Terkirim</span> @endif <span class="teaser">{{ $feedbackTrash->message }}.</span>
                            </a>
                            <div class="date">{{ $feedbackTrash->waktu }}</div>
                        </div>
                    </li>
                    @empty
                    <li  style="height:120px">
                        <div class="my-auto text-center">
                            <h4 class="mt-5" >Tidak ada feedback yang dihapus</h4>
                        </div>
                    </li>
                    @endforelse
                    .
                </ul>
                @elseif($page == 'search')
                <ul class="message-list">
                    @forelse ($searchResult as $feedbackSearch)     
                    @php if($feedbackSearch->to == auth()->user()->id){ $masuk = true;}else{$masuk = false;} @endphp                     
                    <li @if ($masuk) @if (!$feedbackSearch->readTo)  class="unread" @endif @else @if (!$feedbackSearch->readFrom) class="unread" @endif @endif>
                        <div class="col-mail col-mail-1 ps-4">
                            <a href="/feedback/?page=kontak-terkirim&&messageid={{ $feedbackSearch->id }}" class="title">{{ $feedbackSearch->tujuan->email }}</a>
                            <img class="rounded-circle header-profile-user" src="/assets/{{ $feedbackSearch->tujuan->avatar }}" alt="Header Avatar">
                            
                        </div>
                        <div class="col-mail col-mail-2">
                            <a href="/feedback/?page=kontak-terkirim&&messageid={{ $feedbackSearch->id }}" class="subject"> @if($masuk) <span class="bg-info badge me-2">Feedback Masuk</span> @else <span class="bg-primary badge me-2">Feedback Terkirim</span> @endif <span class="teaser">{{ $feedbackSearch->message }}.</span>
                            </a>
                            <div class="date">{{ $feedbackSearch->waktu }}</div>
                        </div>
                    </li>
                    @empty
                    <li  style="height:120px">
                        <div class="my-auto text-center">
                            <h4 class="mt-5" >Feedback tidak ditemukan</h4>
                        </div>
                    </li>
                    @endforelse
                    .
                </ul>
                @endif
            </div>

            <div class="row">
            </div>

        </div> <!-- end Col-9 -->
    {{-- Because she competes with no one, no one can compete with her. --}}
</div>
