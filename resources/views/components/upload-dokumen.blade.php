<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="mb-3">
        <label for="dokumen" class="form-label">Upload Dokumen</label>
        <small class="text-success"><b>*wajib hasil scan ASLI</b> </small>
        <input type="file" class="form-control @error('dokumen') is-invalid @enderror" id="dokumen" wire:model="dokumen">
        @error('dokumen') <span class="invalid-feedback">{{ $message }}</span> @enderror
        @if (count($errors) === 0)
            @livewire('show-dokumen',compact('file'))
        @endif
    </div>
</div>
