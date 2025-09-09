@slot('title','Data Admin')
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
                    <div class="d-flex justify-content-between">
                        <div class="flex-shrink-0 me-3">
                           <h5 class="card-title">Tambah User Admin</h5>
                        </div>
                        <div class="text-end">
                            <div class="flex-0">
                                <a href="/data-admin" class="btn btn-secondary mb-1"> <i class="fas fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="row px-5 border shadow-sm">
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
                                        <input type="text"  id="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                                            @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="nomor_hp">Nomor Telepon</label>
                                        <input type="text"  id="nomor_hp" wire:model="user.nomor_hp" class="form-control @error('user.nomor_hp') is-invalid @enderror">
                                            @error('user.nomor_hp') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="password">Password</label>
                                        <input type="password"  id="password" wire:model="password" class="form-control @error('password') is-invalid @enderror">
                                            @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                        <p class="text-muted">kosongkan untuk default password : sidaperan2023</p>
                                    </div>
                                    <div class="d-flex justify-content-right mt-4">
                                        <button type="submit" class="btn btn-success me-2"> <i class="bx bx-save"></i> Simpan </button>
                                        <button type="button" onclick="Turbolinks.visit('/data-admin')" class="btn btn-secondary"><i class="fas fa-times"></i> Batal</button>
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

