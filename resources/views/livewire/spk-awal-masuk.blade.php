<div>
    
    <div class="col-md-12">
        <div class="card rtc px-2 shadow-lg">
                  @if (!$spkawal)
                      <div class="card-body">
                          <div class="d-flex justify-content-between mb-4">
                              <h4 class="card-title my-auto">Awal Masuk Rumah Sakit</h4>
                              <button type="button" class="btn btn-sm btn-success my-auto py-auto" wire:click="tambahInput">Tambah Pelatihan / Seminar</button>
                          </div>
          
                          <form wire:submit.prevent="save" enctype="multipart/form-data">
                            <div class="row mb-3 border shadow-sm mx-n4 pt-3">
                                <div class="col-md-5 ">
                                    <div class="mb-3">
                                        <label for="unit_ruangan" class="form-label"> Unit Ruangan</label>
                                        <input type="text" class="form-control @error('seminar.unit_ruangan') is-invalid @enderror" id="unit_ruangan" wire:model="seminar.unit_ruangan">
                                        @error('seminar.unit_ruangan') <span class="invalid-feedback">{{ preg_replace('/\d+/', '', str($message)->replace('.',' ')) }}</span> @enderror
                                    </div>
                                    
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label for="spk.{{ $index }}.file" class="form-label">Upload Dokumen</label>
                                        <small class="text-secondary">*File yang di upload wajib hasil Scan ASLI</small>
                                        <input type="file" class="form-control @error('spk.'.$index.'.file') is-invalid @enderror" id="spk.{{ $index }}.dokumen" wire:model="spk.{{ $index }}.file">
                                        @error('spk.'.$index.'.dokumen') <span class="invalid-feedback">{{ preg_replace('/\d+/', '', str($message)->replace('.',' ')) }}</span> @enderror
                                        @if (count($errors) === 0)
                                            <div class="px-3 shadow-sm">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @if (count($spk) !== 1)
                                    <div class="col-md-1 mt-4">
                                        <button id="{{ $index }}" type="button" class="btn btn-danger" wire:click="hapusInput({{ $index }})">Hapus</button>
                                    </div>
                                @endif
                            </div>
                              <div class="d-flex justify-content-center mt-3">
                                  <button type="submit" class="btn btn-primary w-md me-1 " data-turbolinks="false"><i class="bx bx-save"></i> Simpan</button>
                                  <a href="/data-diri/pelatihan-seminar" class="btn btn-secondary w-md"><i class="fas fa-times"></i> Batal</a>
                              </div>
                          </form>
                      </div>
                  @else
                  <div class="card-body">
                    <div class="">
                        <a href="/data-diri/pelatihan-seminar/input" class="btn btn-success float-end"> <i class="bx bx-pencil"></i> Edit Data</a>
                        <h1 class="card-title text-center"> <i class="bx bx-detail"></i> Data Riwayat seminar</h1>
                        {{-- <p class="text-center"> {{ (isset($data->updated_at)) ?? $data->updated_at->format('d F Y') }}</p> --}}
                    </div>
                    <div class="row mt-5">
                        {{-- <div class="row mb-3 border shadow-sm pt-3" wire:key="seminar-{{ $index }}">
                            <div class="rounded-circle col-md-1 bg-primary text-white text-center me-3 text-center" style="width: 30px; height: 30px; font-size: 20px;">
                                {{ $index + 1 }}
                            </div>
                            <div class="col-md-5 ">
                                <div class="d-flex justify-content-between mb-3">
                                    <p class="text-secondary font-weight-bold">Nama Seminar / Pelatihan :</p>
                                    <p class="text-right  lead ps-3"> {{ $pend['nama'] }}</p>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <p class="text-secondary font-weight-bold">Institusi Penyelenggara:</p>
                                    <p class="text-right  lead ps-3"> {{ $pend['institusi'] }}</p>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <p class="text-secondary font-weight-bold">Jenis Seminar / Pelatihan :</p>
                                    <p class="text-right  lead ps-3"> {{ $pend['jenis'] }}</p>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <p class="text-secondary font-weight-bold">Biaya :</p>
                                    <p class="text-right  lead ps-3"> {{ $pend['biaya'] }}</p>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <p class="text-secondary font-weight-bold">Angka Skp:</p>
                                    <p class="text-right  lead ps-3"> {{ $pend['angka_skp'] }}</p>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <p class="text-secondary font-weight-bold">Tanggal Seminar:</p>
                                    <p class="text-right  lead ps-3"> {{ $pend['tanggal_seminar']->format('d F Y') }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="px-3 shadow-sm">
                                    @if ($seminar[$index]['dokumen'])
                                        @isset($seminar[$index]['ext'])
                                            @if ($seminar[$index]['ext'] == 'pdf')
                                            <embed src="/assets/{{$seminar[$index]['dokumen']}}" type="application/pdf" width="450" height="400" >
                                            @else
                                                
                                                <img style="max-width:300px;max-height:400px;" src="/assets/{{ $seminar[$index]['dokumen']}}">
                                            @endif
                                        @endisset
                                    @endif
                                </div>
                            </div>
                        </div> --}}
                     </div>
                        
                    </div>
                    
                  </div>
              @endif
          </div>
    </div>
</div>
