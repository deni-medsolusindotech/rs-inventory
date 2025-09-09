@slot('title','Data User')
@slot('icon','user-circle')
@slot('subtitle',$identifier)
@if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin'))
@push('script')
    <script>
   function terima(){
        Swal.fire({
            title: "Anda Yakin?",
            text: "Apakah Anda yakin ingin menerima dan mengonfirmasi data diri pengguna dengan nama {{ $user->ktp->nama }}?",
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
               @this.terima();
            }
           
        })
     }
     function tolak() {
        Swal.fire({
            title: "Anda yakin?",
            text: "Tolak konfirmasi user {{ $user->ktp->nama }}?",
            input: 'textarea',
            inputPlaceholder: 'Masukkan alasan penolakan...',
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Ya, Tolak",
            cancelButtonText: "Tidak, Batal",
            confirmButtonClass: "btn btn-danger mt-2",
            cancelButtonClass: "btn btn-secondary ms-2 mt-2",
            buttonsStyling: !1
        }).then((result) => {
            if (result.isConfirmed) {
                @this.tolak(result.value)
                // Tindakan jika tombol "Ya, Terima" ditekan
                // Lakukan tindakan terkait penerimaan
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Tindakan jika tombol "Tidak, Batal" ditekan atau SweetAlert ditutup
                // Lakukan tindakan terkait pembatalan
            }
        });
    }
    </script>
@endpush
@endrole
<div>
    {{-- The whole world belongs to you. --}}
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
                                @if ($user->status_verifikasi == 'proses')
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupVerticalDrop1" type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Konfirmasi Data Diri User <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
                                            <div class="dropdown-item d-flex justify-content-between">
                                                <a class="btn btn-outline-primary me-1" onclick="terima()"> <i class="bx bx-check-circle"></i> Terima</a>
                                                <a class="btn btn-outline-danger" onclick="tolak()"> <i class="bx bx-error-circle"></i> Tolak</a>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($user->status_verifikasi == 'terima')
                                    <h6 class="text-muted"> <span class="badge badge-xl bg-success">Di Terima</span> <span class="text-muted">{{ $user->statusKonfirmasi->updated_at->format('d F Y') }}</span></h6>
                                    <p>By : {{ $user->statusKonfirmasi->by->email }}</p>
                                @elseif ($user->status_verifikasi == 'tolak')
                                    <h6 class="text-muted"> <span class="badge badge-xl bg-danger">Di Tolak</span> <span class="text-muted">{{ $user->statusKonfirmasi->updated_at->format('d F Y') }}</span></h6>
                                    <p>By : {{ $user->statusKonfirmasi->by->email }}</p>
                                @endif
                            @endif

                            @role(['perawat','umum','dokter','bidan','penunjang_medis'])
                                <div class="flex-0">
                                    <a href="/profile/edit" class="btn btn-success btn-sm mb-1"> <i class="bx bx-edit"></i> Edit Profile</a>
                                </div>
                                @if ($user->status_verifikasi == 'proses')
                                    <span class="badge badge-xl bg-info">Di {{ $user->status_verifikasi }}</span>
                                @elseif($user->status_verifikasi != "")
                                <div class="flex-1 m-0">
                                    <h6 class="text-muted m-0"> <span class="badge badge-xl @if ($user->status_verifikasi == 'terima') bg-primary  @elseif ($user->status_verifikasi == 'tolak') bg-danger @elseif ($user->status_verifikasi == 'proses') bg-info @endif  ">Di {{ $user->status_verifikasi }}</span> <span class="text-muted">{{ $user->statusKonfirmasi->updated_at->format('d F Y') }}</span></h6>
                                    <p class="m-0">By : {{ $user->statusKonfirmasi->by->email }}</p>
                                </div>
                                @endif
                            @endrole

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-lg rounded ">
                <div class="card-body">
                    <div class="">
                        <h5 class="font-size-14">Data Diri </h5>
                        <p class="card-title-desc">Terdapat sembilan bagian diantaranya data KTP, NPWP, Status Kepegawaian, Riwayat pendidikan Dan Lainnya.</p>

                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Kartu Tanda Penduduk (KTP)
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6 bg-info rounded shadow-sm p-4 bg-soft">
                                                <div class="ktp-container">
                                                    <div class="ktp-photo"></div>
                                                    <div class="ktp-info rounded">
                                                        <div>
                                                            <h4 class="text-center">KARTU TANDA PENDUDUK </h4>
                                                            <hr>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-9">
                                                                <div class="row my-n1">
                                                                    <div class="col-5">
                                                                    <h5><b>NIK</b> </h5>
                                                                    </div>
                                                                    <div class="col-7">
                                                                    <h5><b> : {{ $user->ktp->nik }}</b></h5>
                                                                    </div>
                                                                </div>
                                                                <div class="row my-n1">
                                                                    <div class="col-5">
                                                                    <h6>Nama</h6>
                                                                    </div>
                                                                    <div class="col-7">
                                                                    <h6 class="text-uppercase">: {{ $user->ktp->nama }}</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="row my-n1">
                                                                    <div class="col-5">
                                                                    <h6 >Tempat/Tanggal Lahir</h6>
                                                                    </div>
                                                                    <div class="col-7">
                                                                    <h6 class="text-uppercase">: {{ $user->ktp->tempat_lahir }} , {{ $user->ktp->tanggal_lahir->format('d F Y') }} </h6>
                                                                    </div>
                                                                </div>
                                                                <div class="row my-n1">
                                                                    <div class="col-5">
                                                                    <h6 >Jenis Kelamin</h6>
                                                                    </div>
                                                                    <div class="col-7">
                                                                    <h6 class="text-uppercase">: {{ $user->ktp->jenis_kelamin }}</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="row my-n1">
                                                                    <div class="col-5">
                                                                    <h6 >Alamat</h6>
                                                                    </div>
                                                                    <div class="col-7">
                                                                    <h6 class="text-uppercase">: {{ $user->ktp->alamat }}</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="row my-n1">
                                                                    <div class="col-5">
                                                                    <h6 class="ms-4" >RT/RW</h6>
                                                                    </div>
                                                                    <div class="col-7">
                                                                    <h6 class="text-uppercase">: {{ $user->ktp->rt_rw }}</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="row my-n1">
                                                                    <div class="col-5">
                                                                    <h6 class="ms-4" >Kel/Desa</h6>
                                                                    </div>
                                                                    <div class="col-7">
                                                                    <h6 class="text-uppercase">: {{ $user->ktp->kelurahan_desa }}</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="row my-n1">
                                                                    <div class="col-5">
                                                                    <h6 class="ms-4">Kecamatan</h6>
                                                                    </div>
                                                                    <div class="col-7">
                                                                    <h6 class="text-uppercase">: {{ $user->ktp->kecamatan }}</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="row my-n1">
                                                                    <div class="col-5">
                                                                    <h6 >Agama</h6>
                                                                    </div>
                                                                    <div class="col-7">
                                                                    <h6 class="text-uppercase">: {{ $user->ktp->agama }}</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="row my-n1">
                                                                    <div class="col-5">
                                                                    <h6 >Status Perkawinan</h6>
                                                                    </div>
                                                                    <div class="col-7">
                                                                    <h6 class="text-uppercase">: {{ $user->ktp->status_perkawinan }}</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="row my-n1">
                                                                    <div class="col-5">
                                                                    <h6 >Pekerjaan</h6>
                                                                    </div>
                                                                    <div class="col-7">
                                                                    <h6 class="text-uppercase">: {{ $user->ktp->pekerjaan }}</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="row my-n1">
                                                                    <div class="col-5">
                                                                    <h6 >Kewarganegaraan</h6>
                                                                    </div>
                                                                    <div class="col-7">
                                                                    <h6 class="text-uppercase">: {{ $user->ktp->kewarga_negaraan }}</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <img src="/assets/{{ $user->ktp->foto }}" style="height:140px;width:105px;" class="avatar-md mt-4" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                               @livewire('show-dokumen',['file'=> $user->ktp->dokumen])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Nomor Pokok Wajib Pajak (NPWP)
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-6 ">
                                                <div class="border border-secondary rounded shadow-sm p-2">
                                                  <div class="bg-warning bg-soft">
                                                      <h4 class="text-center pt-1">NOMOR POKOK WAJIB PAJAK </h4>
                                                      <hr>
                                                  </div>
                                                  <div class="px-5">
                                                    <div class="row my-n1 mb-1">
                                                      <h3>NPWP : {{ $user->npwp->nomor ?? 'xx.xxx.xxx.x-xxx.xxx' }}</h3>
                                                    </div>
                                                    <div class="row my-2">
                                                      <h4 class="text-uppercase">{{ $user->ktp->nama ?? '' }}</h4>
                                                    </div>
                                                    <div class="row my-2">
                                                      <h5 class="text-uppercase">{{ $user->ktp->alamat ?? '' }}, RT/RW {{ $user->ktp->rt_rw ?? ''}}, Kel/Desa {{ $user->ktp->kelurahan_desa ?? ''}}, Kec. {{ $user->ktp->kecamatan ?? '' }}</h5>
                                                    </div>
                                                  </div>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                                @livewire('show-dokumen',['file'=> $user->npwp->dokumen])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Status Kepegawaian
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row p-5">
                                            <div class="col-md-6">
        
                                                <p class="text-secondary font-weight-bold">Status :</p>
                                                @if ($user->spkawal->status == 'pns')
                                                <p class="text-right text-capitalize text-truncate lead ps-3"> Pegawai Negeri Sipil (PNS) / Aparatur Sipil Negara (ASN)</p>
                                                
                                                @elseif ($user->spkawal->status == 'pppk')
                                                <p class="text-right text-capitalize text-truncate lead ps-3"> Pemerintah dengan Perjanjian Kerja (PPPK)</p>
                                                
                                                @elseif ($user->spkawal->status == 'non_pns')
                                                <p class="text-right text-capitalize text-truncate lead ps-3">Non Pegawai Negeri Sipil (Non PNS)</p>
                                                
                                                @endif
                                            </div>
                                            @if ($user->spkawal->status == 'pppk')
                                                <div class="col-md-6 px-0">
                                                    @livewire('show-dokumen',['file' => $user->spkawal->dokumen])
                                                </div>
                                            @endif

                                            <hr class="mt-2">
                                                <h1 class="card-title text-center"> Status Kontrak Sekarang : <u>{{ ($user->status->status) ? 'Berbeda' : 'Tetap'; }}</u>  dengan Awal Masuk Rumah Sakit</h1>
                                            <hr>
                                            @if($user->status->status)
                                            <div class="mb-2 col-md-6">
                                                    <p class="text-secondary font-weight-bold">Status :</p>
                                                    @if ($user->status->status == 'pns')
                                                    <p class="text-right text-capitalize text-truncate lead ps-3"> Pegawai Negeri Sipil (PNS) / Aparatur Sipil Negara (ASN)</p>
                                                    
                                                    @elseif ($user->status->status == 'pppk')
                                                    <p class="text-right text-capitalize text-truncate lead ps-3"> Pemerintah dengan Perjanjian Kerja (PPPK)</p>
                                                    
                                                    @elseif ($user->status->status == 'non_pns')
                                                    <p class="text-right text-capitalize text-truncate lead ps-3">Non Pegawai Negeri Sipil (Non PNS)</p>
                                                    @endif
                                            </div>
                                            @endif
                                            @if ($user->status->status !== 'non_pns')
                                                
                                            <div class="mb-2 col-md-6">
                                                <p class="text-secondary font-weight-bold">Nomor Induk Pegawai (NIP) :</p>
                                                <p class="text-right text-capitalize text-truncate lead ps-3">{{ $user->status->nip }}</p>
                                            </div>
                                            <div class="mb-2 col-md-6">
                                                <p class="text-secondary font-weight-bold">Pangkat </p>
                                               <p class="text-right text-capitalize text-truncate lead ps-3">{{ $user->status->pangkat->pangkat }} Golongan: {{ $user->status->pangkat->golongan }} Ruang: {{ $user->status->pangkat->ruang }}</p>
                                            </div>
                                            @else
                                            <div class="mb-2 col-md-6">
                                                <p class="text-secondary font-weight-bold">Nomor Registrasi Kependudukan (NRK) :</p>
                                                <p class="text-right text-capitalize text-truncate lead ps-3">{{ $user->status->nrk }}</p>
                                            </div>
                                            
                                            @endif
                                            <div class="mb-2 col-md-6">
                                                <p class="text-secondary font-weight-bold">Jenis Logbook :</p>
                                                <p class="text-right text-capitalize text-truncate lead ps-3">{{ $user->status->jenis_logbook }}</p>
                                            </div>
                                          </div>
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pendidikan" aria-expanded="false" aria-controls="pendidikan">
                                    Riwayat Pendidikan ({{ $user->pendidikan->count() }})
                                    </button>
                                </h2>
                                <div id="pendidikan" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        @foreach ($user->pendidikan as $index => $pend)
                            
                                        <div class="row mb-3 border shadow-sm pt-3" wire:key="pendidikan-{{ $index }}">
                                            <div class="rounded-circle col-md-1 bg-primary text-white text-center me-3 text-center" style="width: 30px; height: 30px; font-size: 20px;">
                                                {{ $index + 1 }}
                                            </div>
                                            <div class="col-md-5 ">
                                                <div class="d-flex justify-content-between mb-3">
                                                    <p class="text-secondary font-weight-bold">Jenjang Pendidikan :</p>
                                                    <p class="text-right  lead ps-3"> {{ $pend['jenjang_pendidikan'] }}</p>
                                                </div>
                                                <div class="d-flex justify-content-between mb-3">
                                                    <p class="text-secondary font-weight-bold">Nama Sekolah :</p>
                                                    <p class="text-right  lead ps-3"> {{ $pend['nama_sekolah'] }}</p>
                                                </div>
                                                <div class="d-flex justify-content-between mb-3">
                                                    <p class="text-secondary font-weight-bold">Nomor Ijazah:</p>
                                                    <p class="text-right  lead ps-3"> {{ $pend['nomor_ijazah'] }}</p>
                                                </div>
                                                <div class="d-flex justify-content-between mb-3">
                                                    <p class="text-secondary font-weight-bold">Gelar:</p>
                                                    <p class="text-right  lead ps-3"> {{ $pend['gelar'] }}</p>
                                                </div>
                                                <div class="d-flex justify-content-between mb-3">
                                                    <p class="text-secondary font-weight-bold">Tanggal Lulus:</p>
                                                    <p class="text-right  lead ps-3"> {{ $pend['tanggal_lulus']->format('d F Y') }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="px-3 shadow-sm">
                                                    @if ($pend->ext == 'pdf')
                                                        <embed src="/assets/{{$pend->dokumen}}" type="application/pdf" width="450" height="400" >
                                                    @else
                                                        <img style="max-width:300px;max-height:400px;" src="/assets/{{ $pend->dokumen}}">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                            @if ($user->status_medis != 'umum')
        
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#str" aria-expanded="false" aria-controls="str">
                                        Surat Tanda Registrasi (STR)
                                        </button>
                                    </h2>
                                    <div id="str" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3 p-5 pt-4">
                                                    <div class="d-flex justify-content-between mb-3">
                                                        <p class="text-secondary font-weight-bold">Nomor STR :</p>
                                                        <p class="lead  ps-3">{{ $user->str->nomor }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between mb-3">
                                                        <p class="text-secondary font-weight-bold">Tanggal STR :</p>
                                                        <p class="lead ps-3">{{ $user->str->tanggal->format('d F Y') }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between mb-3">
                                                        <p class="text-secondary font-weight-bold">Tanggal Kadaluarsa :</p>
                                                        <p class="lead ps-3">{{ $user->str->tanggal_kadaluarsa->format('d F Y') }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    @livewire('show-dokumen',['file'=> $user->str->dokumen])
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sipp" aria-expanded="false" aria-controls="sipp">
                                        Surat Izin Praktek Perawat
                                        </button>
                                    </h2>
                                    <div id="sipp" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3 p-5 pt-4">
                                                    <div class="d-flex justify-content-between mb-3">
                                                        <p class="text-secondary font-weight-bold">Status SIPP :</p>
                                                        <p class="lead  ps-3 text-uppercase">{{ str($user->sipp->status)->replace('_'," ") }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between mb-3">
                                                        <p class="text-secondary font-weight-bold">Nomor SIPP :</p>
                                                        <p class="lead  ps-3">{{ $user->sipp->nomor }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between mb-3">
                                                        <p class="text-secondary font-weight-bold">Tanggal SIPP :</p>
                                                        <p class="lead ps-3">{{ $user->sipp->tanggal->format('d F Y') }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between mb-3">
                                                        <p class="text-secondary font-weight-bold">Tanggal Kadaluarsa :</p>
                                                        <p class="lead ps-3">{{ $user->sipp->tanggal_kadaluarsa->format('d F Y') }}</p>
                                                    </div>
                                                </div>
                                            <div class="col-md-6">
                                                @livewire('show-dokumen',['file'=> $user->sipp->dokumen])
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            
                            @endif
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#kewenangan" aria-expanded="false" aria-controls="kewenangan">
                                   Kewenangan Klinis
                                    </button>
                                </h2>
                                <div id="kewenangan" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-md-12 mb-3 ">
                                                <div class="border p-3 shadow-sm text-center ">
                                                <p class="lead text-center text-uppercase">Status {{ str($user->kewenangan->pk)->replace('_',' ') }} / {{ $user->kewenangan->sub_pk }} </p>
                                                <hr>
                                                @livewire('show-dokumen',['file'=> $user->kewenangan->dokumen])
                                                </div>
                                            </div>
                                      </div>
                                    </div>
                                </div>
                            </div> <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#seminar" aria-expanded="false" aria-controls="seminar">
                                    Pelatihan Dan Seminar ({{ $user->seminar->count() }})
                                    </button>
                                </h2>
                                <div id="seminar" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        @foreach ($user->seminar as $index => $pend)
                                            <div class="row mb-3 border shadow-sm pt-3" wire:key="seminar-{{ $index }}">
                                                <div class="rounded-circle col-md-1 bg-primary text-white text-center me-3 text-center" style="width: 30px; height: 30px; font-size: 20px;">
                                                    {{ $index + 1 }}
                                                </div>
                                                <div class="col-md-5 ">
                                                    <div class="d-flex justify-content-between mb-3">
                                                        <p class="text-secondary font-weight-bold">Nama Seminar / Pelatihan :</p>
                                                        <p class="text-right  lead ps-3"> {{ $pend['nama'] }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between mb-3">
                                                        <p class="text-secondary font-weight-bold">Biaya :</p>
                                                        <p class="text-right  lead ps-3"> {{ $pend['biaya'] }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between mb-3">
                                                        <p class="text-secondary font-weight-bold">Jenis Seminar / Pelatihan :</p>
                                                        <p class="text-right  lead ps-3"> {{ $pend['jenis'] }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between mb-3">
                                                        <p class="text-secondary font-weight-bold">Institusi Penyelenggara:</p>
                                                        <p class="text-right  lead ps-3"> {{ $pend['institusi'] }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between mb-3">
                                                        <p class="text-secondary font-weight-bold">Angka Skp:</p>
                                                        <p class="text-right  lead ps-3"> {{ $pend['angka_skp'] }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between mb-3">
                                                        <p class="text-secondary font-weight-bold">Jam Mata Pelajaran:</p>
                                                        <p class="text-right  lead ps-3"> {{ $pend['jam_pelajaran'] }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between mb-3">
                                                        <p class="text-secondary font-weight-bold">Tanggal Seminar:</p>
                                                        <p class="text-right  lead ps-3"> {{ $pend['tanggal_seminar']->format('d F Y') }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="px-3 shadow-sm">
                                                        @if ($pend->ext == 'pdf')
                                                            <embed src="/assets/{{$pend->dokumen}}" type="application/pdf" width="450" height="400" >
                                                        @else
                                                            <img style="max-width:300px;max-height:400px;" src="/assets/{{ $pend->dokumen}}">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div> <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#spk" aria-expanded="false" aria-controls="spk">
                                        Surat Perintah Kerja / Mutasi ({{ $user->spk->filter(function ($item) {
                                            return $item['konfirmasi'] == null || $item['konfirmasi'] == 'terima';
                                        })->count() }})
                                    </button>
                                </h2>
                                <div id="spk" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        @foreach ($user->spk->filter(function ($item) {
                                            return $item['konfirmasi'] == null || $item['konfirmasi'] == 'terima';
                                        }) as $spk)
                                            <button class="btn btn-primary rounded-circle">{{ $loop->iteration }}</button>
                                        <div class="row">
                                            <div class="col-md-6 mb-3 p-5 pt-4">
                                                <div class="d-flex justify-content-between mb-3">
                                                    <p class="text-secondary font-weight-bold">Unit / Ruangan :</p>
                                                    <p class="lead ps-3">{{ $spk->unit_ruangan }}</p>
                                                </div>
                                                <div class="d-flex justify-content-between mb-3">
                                                    <p class="text-secondary font-weight-bold">Tanggal SPKI :</p>
                                                    <p class="lead ps-3">{{ $spk->tanggal_spki->format('d F Y') }}</p>
                                                </div>
                                                <div class="d-flex justify-content-between mb-3">
                                                    <p class="text-secondary font-weight-bold">Tanggal Selesai :</p>
                                                    <p class="lead ps-3">{{ $spk->tanggal_selesai->format('d F Y') }}</p>
                                                </div>
                                                <div class="d-flex justify-content-between mb-3">
                                                    <p class="text-secondary font-weight-bold">Penempatan :</p>
                                                    <p class="lead ps-3">{{ $spk->tempat_tujuan }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                @livewire('show-dokumen',['file'=> $spk->dokumen])
                                            </div>
                                        </div>
                                        @if ($spk->konfirmasi == 'terima')
                                            <div class="border rounded-pill p-3 text-center w-full mt-2 text-muted">
                                                Di ajukan Pada {{ $spk->created_at->format('d F, Y') }} {{ $spk->created_at->diffForHumans() }} dan di Terima Oleh {{ $spk->konfirmasi_by }} pada {{ $spk->konfirmasi_at->format('d F, Y') }} 
                                            </div>
                                        @endif
                                        <hr>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end accordion -->
                    </div>
                </div>
            </div>
        </div>
    </div>
  
</div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

</div>
