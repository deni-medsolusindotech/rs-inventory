@slot('title','Edit Profile')
@slot('icon','profile')
@push('style')
 <style>
    .profile-container {
  position: relative;
  display: inline-block;
}

.profile-image {
  display: block;
  width: 250px; /* Ubah sesuai dengan ukuran foto profil */
  height: auto;
}

.edit-icon {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  opacity: 0;
  transition: opacity 0.3s ease;
  font-size: 130px;
}

.profile-container:hover .edit-icon {
  opacity: 1;
}

.fa-upload {
  font-size: 70px;
  color: white;
  background-color: rgba(0, 0, 0, 0.5);
  padding: 8px;
  border-radius: 50%;
}

 </style>
@endpush
@push('script-bottom')
<script>
    $('.button-tab-edit').on('click',function(){
        @this.page = $(this).attr('data-link');
    })
    $('.button-show-password').on('click', function(){
        let target = $(this).attr('data-target');
        let status = $(this).attr('data-show');
        
        if(status == 1){
            $(this).attr('data-show',0)
            $(this).html("<i class='mdi mdi-eye-outline'></i>")
            $('#'+target).attr('type','password')
        }else{
            $(this).html("<i class='mdi mdi-eye-off-outline'></i>")
            $(this).attr('data-show',1)
            $('#'+target).attr('type','text')
        }
    });
</script>
@endpush
<div>
    {{-- The whole world belongs to you. --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card rtc shadow-lg" style="min-height: 400px;">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <img src="/assets/{{ auth()->user()->avatar }}" alt="" class="avatar-md rounded-circle img-thumbnail">
                        </div>
                        <div class="flex-grow-1 align-self-center">
                            <div class="text-muted">
                                <h5>{{ auth()->user()->name }}</h5>
                                <p class="mb-1">{{ auth()->user()->email }}</p>
                                <p class="mb-0">{{ str(auth()->user()->status_medis)->headline() }}</p>
                            </div>
                        </div>
                        <div class="">
                            <div class="flex-0">
                                <a href="/dashboard" class="btn btn-secondary mb-1"> <i class="fas fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-2 px-5 border shadow-sm">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link button-tab-edit  @if($page == 'edit-profile') active @endif" data-bs-toggle="tab" href="#home1" role="tab" data-link="edit-profile">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block"> <i class="mdi mdi-account-edit-outline"></i> Edit Profile</span> 
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link button-tab-edit @if($page == 'edit-password') active @endif" data-bs-toggle="tab" href="#profile1" role="tab" data-link="edit-password">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                    <span class="d-none d-sm-block"> <i class="mdi mdi-form-textbox-password"></i> Edit Password</span> 
                                </a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content p-3 text-muted">
                            <div class="tab-pane @if($page == 'edit-profile') active @endif" id="home1" role="tabpanel">
                                <form wire:submit.prevent="EditProfile" enctype="multipart/form-data">
                                    <div class="row mt-3">
                                        <div class="col-md-5">
                                            <div class="text-center">
                                                <div class="profile-container">
                                                    @if ($avatar)
                                                        <img class="profile-image rounded-circle mx-auto border shadow-md"  src="{{ $avatar->temporaryUrl() }}" alt="Foto Profil">
                                                    @else
                                                        <img class="profile-image rounded-circle mx-auto border shadow-md"  src="/assets/{{ $user->avatar }}" alt="Foto Profil">
                                                    @endif
                                                        <div class="edit-icon">
                                                            <label for="upload_gambar">
                                                                <i class="fas fa-upload"></i>
                                                            </label>
                                                            <input class="d-none" type="file" wire:model="avatar" id="upload_gambar">
                                                        </div>
                                                    </div>                                                                  
                                            </div>
                                            @error('avatar')
                                                <p class="small text-danger text-center">* {{ $message }} </p>
                                            @enderror
                                        </div>
                                        <div class="col-md-7">
                                            <div class="mb-3">
                                                <label for="name">Nama</label>
                                                <input type="text"  id="name" wire:model="user.name" class="form-control @error('user.name') is-invalid @enderror">
                                                    @error('user.name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="email">Email</label>
                                                <input type="text"  id="email" wire:model="user.email" class="form-control @error('user.email') is-invalid @enderror">
                                                    @error('user.email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="nomor_hp">Nomor Telepon</label>
                                                <input type="text"  id="nomor_hp" wire:model="user.nomor_hp" class="form-control @error('user.nomor_hp') is-invalid @enderror">
                                                    @error('user.nomor_hp') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="d-flex justify-content-right mt-4">
                                                <button type="submit" class="btn btn-success me-2"> <i class="bx bx-save"></i> Edit Profile</button>
                                                <button type="button" onclick="Turbolinks.visit('/dashboard')" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane  @if($page == 'edit-password') active @endif" id="profile1" role="tabpanel">
                               <form wire:submit.prevent="EditPassword">
                                 <div class="d-flex justify-content-center mt-3">
                                    <div class="col-md-7">
                                        <div class="mb-3">
                                            <label for="password">Password</label>
                                            <div class="input-group">
                                                <input type="password"  id="password" wire:model.defer="password" class="form-control @error('password') is-invalid @enderror">
                                                <span data-show="0" data-target="password"  class="input-group-text button-show-password"><i class="mdi mdi-eye-outline"></i></span>
                                                @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password_baru">Password Baru</label>
                                        <div class="input-group">
                                            <input type="password"  id="password_baru" wire:model.defer="password_baru" class="form-control @error('password_baru') is-invalid @enderror">
                                            <span  data-show="0" data-target="password_baru"   class="input-group-text button-show-password"><i class="mdi mdi-eye-outline"></i></span>
                                            @error('password_baru') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password_baru_confirmation">Konfirmasi Password</label>
                                        <div class="input-group">
                                            <input type="password"  id="password_baru_confirmation" wire:model.defer="password_baru_confirmation" class="form-control @error('password_baru_confirmation') is-invalid @enderror">
                                            <span  data-show="0" data-target="password_baru_confirmation"   class="input-group-text button-show-password"><i class="mdi mdi-eye-outline"></i></span>
                                            @error('password_baru_confirmation') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        </div>
                                        </div>
                                        <div class="d-flex justify-content-center mt-4">
                                            <button type="submit" class="btn btn-success me-2"> <i class="bx bx-save"></i> Edit Password</button>
                                            <button type="button" onclick="Turbolinks.visit('/dashboard')" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</button>
                                        </div>
                                    </div>
                                 </div>
                               </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

