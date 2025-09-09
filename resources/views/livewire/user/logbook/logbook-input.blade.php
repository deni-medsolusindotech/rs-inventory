@slot('title','Log Book Perawat')
@slot('subtitle','Input Logbook Hari Ini')
@slot('icon','book')
@push('body')
data-keep-enlarged="true" class="vertical-collpsed"
@endpush
@push('style')
    <link href="/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
@endpush
@push('script')
<script src="/assets/libs/select2/js/select2.min.js"></script>
@endpush
@push('script-bottom')
    <script>
        function select(){
            $(".select").select2();
            $(".select2").select2();
        }

        $('#jenis_logbook').on('change',function(){
            @this.jenis_logbook = $(this).val();
        })
        Livewire.on('select',function(){
            select()
        })
        select()
    </script>
@endpush
<div>
    <x-status-verifikasi/>
    {{-- The whole world belongs to you. --}}
    <div class="row">
        <div class="col-lg-12">
            <form wire:submit.prevent="simpan">
            <div class="card rtc shadow-lg" style="min-height: 400px;">
                <div class="d-flex justify-content-between mt-2 px-4">
                    <div class="col-md-4"  wire:ignore>
                       <h4>Kegiatan {{ auth()->user()->status->jenis_logbook }}</h4>
                    </div>
                    <div class="col-md-4" >
                        <div class="float-end">
                            <a href="/log-book" class="btn btn-secondary"> <i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="card-body">
                  <div>
                    @if($jenis_logbook)
                        @livewire('user.logbook.input-jenis-kegiatan')
                    @else
                        <div class="text-center mt-5">
                            <p class="pt-5"> <i class="bx bx-info-circle"></i> Pilih Jenis logbook terdahulu</p>
                        </div>
                    @endif
                   
                  </div>
                </div>
                @if($jenis_logbook)
                    <div class="card-footer bg-white">
                        <div class="pb-2 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success me-2" > <i class="bx bxs-save"></i> Simpan logbook</button>
                            <button type="button" class="btn btn-primary" wire:click="tambah"> <i class="bx bx-add-to-queue"></i> Tambah kegiatan</button>
                            {{-- <a href="/log-book" class="btn btn-secondary"> <i class="fas fa-times"></i> Batal</a> --}}
                        </div>
                    </div>
                @endif
            </div>
        </form>
        </div>
    </div>
</div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

</div>
