@push('script')
    <script>
        Livewire.on('select',function(){
            $('select2').select2();
        })
        function set(index,val){
            @this.setValue(index,val) 
        }
    </script>
@endpush
<div>  
        @foreach ($logbook as $index => $bukuputih)
        <div class="row">
            <div class="mb-3 col-md-9">
                <div class="row p-0 m-0">
                    <div class="col-md-1 p-0 m-0 text-center">
                        <button class="btn btn-outline-success rounded-circle  @if( $loop->first ) mt-4 @endif" type="button"> {{ $loop->iteration }}</button>
                    </div>
                    <div class="col-md-11  p-0 m-0">
                        @if( $loop->first )
                            <label for="jenis_kegiatan_{{ $index }}">Jenis kegiatan </label>
                        @endif
                        <select class="form-control select2 select{{ $index }} @error("logbook.$index.kegiatan_id") is-invalid @enderror" id="jenis_kegiatan_{{ $index }}" onchange="@this.setValue({{ $index }},$(this).val())" >                               
                            @forelse ($kegiatans as $jk)
                                @if( $loop->first )
                                <option hidden> Pilih Kegiatan</option>
                                @endif
                                <option value="{{ $jk->id }}" @if ($jk->id == $bukuputih['kegiatan_id']) class="selected" selected="selected" @endif> {{ $jk->isi }} </option>
                            @empty
                                <option hidden> Isi jenis logbook pada data diri status kepegawaian </option>
                            @endforelse
                        </select>
                        @error("logbook.$index.kegiatan_id")
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3 col-md-3">
                @if( $loop->first )
                    <label for="">Nomor RM</label>
                @endif
                <div class=" input-group">
                    <input type="text" wire:model.defer="logbook.{{ $index }}.no_rm" class="form-control @error("logbook.$index.no_rm") is-invalid @enderror" id="no_rm_{{ $index }}" aria-describedby="tombol_hapus_{{ $index }}">
                    @if (count($logbook) != 1)
                        <button class="btn btn-danger" type="button" id="tombol_hapus_{{ $index }}" wire:click="hapus({{ $index }})"> <i class="bx bx-trash"></i></button>
                    @endif
                    @error("logbook.$index.no_rm")
                        <span class="invalid-feedback">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div> 
        </div>
        @endforeach
</form>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
</div>
