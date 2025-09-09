<x-app-layout>
    @slot('title','Dashboard')
    @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin'))
    <div class="checkout-tabs">
        <div class="row">
            <div class="col-lg-2">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-gen-ques-tab" data-bs-toggle="pill" href="#v-pills-gen-ques" role="tab" aria-controls="v-pills-gen-ques" aria-selected="true">
                        <i class= "bx bx-user-circle d-block check-nav-icon mt-4 mb-2"></i>
                        <p class="fw-bold mb-4">Data User</p>
                    </a>
                     @if (auth()->user()->hasRole('super_admin'))
                    <a class="nav-link" id="v-pills-privacy-tab" data-bs-toggle="pill" href="#v-pills-privacy" role="tab" aria-controls="v-pills-privacy" aria-selected="false"> 
                        <i class= "bx bx-user-circle  d-block check-nav-icon mt-4 mb-2"></i>
                        <p class="fw-bold mb-4">Data Admin</p>
                    </a>
                    @endif
                    <a class="nav-link" id="v-pills-support-tab" data-bs-toggle="pill" href="#v-pills-support" role="tab" aria-controls="v-pills-support" aria-selected="false">
                        <i class= "bx bx-task d-block check-nav-icon mt-4 mb-2"></i>
                        <p class="fw-bold mb-4">Pengajuan</p>
                    </a>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-gen-ques" role="tabpanel" aria-labelledby="v-pills-gen-ques-tab">
                                <h4 class="card-title mb-5">Data Diri</h4>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Masuk Fitur User</h5>
                                        <p class="text-muted">Masuk Fitur User dan lakukan verifikasi data diri perawat.</p>
                                    </div>
                                </div>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Pastikan data diri perawat di verifikasi dengan teliti</h5>
                                        <p class="text-muted">Data diri perawat terdiri dari beberapa bagian.Pastikan kamu melihat data secara keseluruhan</p>
                                    </div>
                                </div>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Verifikasi data user</h5>
                                        <p class="text-muted">Setelah memastikan tidak ada kesalahan data diri user terima konfirmasi.Jika ada kesalahan tolak konfirmasi dan masukan alasan nya.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-privacy" role="tabpanel" aria-labelledby="v-pills-privacy-tab">
                                <h4 class="card-title mb-5">Data User Admin</h4>
                                
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Masuk Fitur Data Admin</h5>
                                        <p class="text-muted">Masuk dan lihat data admin, akun admin untuk melakukan beberapa tugas seperti memverifikasi dan memonitoring data.Anda dapat meregistrasi dan menghapus data admin sesuai kebutuhan.</p>
                                    </div>
                                </div>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Tambah Admin</h5>
                                        <p class="text-muted">Tambahkan user admin jika diperlukan dan pastikan mengisi data profile dengan baik.Kosongkan jika ingin password sementara secara default (sidaperan2023) hingga admin sendiri yang mengeditnya</p>
                                    </div>
                                </div>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Edit password bagian profile admin jika diperlukan</h5>
                                        <p class="text-muted">Lakukan jika admin lupa kata sandi atau karna alasan lainnya.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-support" role="tabpanel" aria-labelledby="v-pills-support-tab">
                                <h4 class="card-title mb-5">SPK Pengajuan</h4>
                            
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Masuk fitur pengajuan</h5>
                                        <p class="text-muted">Cek fitur pengajuan dan laukan verifikasi jika ada pengajuan dari perawat.</p>
                                    </div>
                                </div>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Cek data form kredensial dan form k3 yang dikirim perawat</h5>
                                        <p class="text-muted">Cek data pengajuan dan pastikan tidak ada kesalahan untuk di verifikasi.</p>
                                    </div>
                                </div>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Tolak Pengajuan dan isi alasanya </h5>
                                        <p class="text-muted">Tolak Pengajuan jika terdapat kesalahan atau alasan tertentu, dan masukan alasan tersebut agar diketahui perawat</p>
                                    </div>
                                </div>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Terima Pengajuan dan input perubahan data diri perawat</h5>
                                        <p class="text-muted">Terima pengajuan jika tidak terdapat kesalahan dan isi data perubahan : pangkat/golongan, jenis logbook, Str tanggal kadaluarsa dan kewenangan klinis.
                                            Pastikan mengisi data ini sesuai dengan data pengajuan dan ketentuan pihak RS.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else

    <div class="checkout-tabs">
        <div class="row">
            <div class="col-lg-2">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-gen-ques-tab" data-bs-toggle="pill" href="#v-pills-gen-ques" role="tab" aria-controls="v-pills-gen-ques" aria-selected="true">
                        <i class= "bx bx-user-circle d-block check-nav-icon mt-4 mb-2"></i>
                        <p class="fw-bold mb-4">Data Diri</p>
                    </a>
                    <a class="nav-link" id="v-pills-privacy-tab" data-bs-toggle="pill" href="#v-pills-privacy" role="tab" aria-controls="v-pills-privacy" aria-selected="false"> 
                        <i class= "bx bx-task d-block check-nav-icon mt-4 mb-2"></i>
                        <p class="fw-bold mb-4">Logbook</p>
                    </a>
                    <a class="nav-link" id="v-pills-support-tab" data-bs-toggle="pill" href="#v-pills-support" role="tab" aria-controls="v-pills-support" aria-selected="false">
                        <i class= "bx bx-task d-block check-nav-icon mt-4 mb-2"></i>
                        <p class="fw-bold mb-4">Pengajuan</p>
                    </a>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-gen-ques" role="tabpanel" aria-labelledby="v-pills-gen-ques-tab">
                                <h4 class="card-title mb-5">Data Diri</h4>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Lengkapi data diri</h5>
                                        <p class="text-muted">Data diri memiliki beberapa bagian diantaranya KTP, NPWP, Status kepegawaian, Pendidikan dan lain-lain.</p>
                                    </div>
                                </div>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Pastikan data diri di isi dengan data yang valid</h5>
                                        <p class="text-muted">Pastikan anda melengkapi data diri dengan baik dan lengkap , serta upload dokumen dengan isi yang jelas.</p>
                                    </div>
                                </div>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Kirim data diri untuk di Verifikasi</h5>
                                        <p class="text-muted">Setelah melengkapi data anda harus mengirim data diri untuk di verifikasi oleh administrator kami.</p>
                                    </div>
                                </div>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Tunggu proses verifikasi</h5>
                                        <p class="text-muted">Tunggu Hingga admin selesai memproses konfirmasi data diri anda sampai ada pemberitahuan ( notifikasi ).</p>
                                    </div>
                                </div>
                                <div class="faq-box d-flex">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Perbaiki kesalahan jika data diri di tolak</h5>
                                        <p class="text-muted">Anda dapat memperbaiki kesalahan input data diri jika di tolak dan bisa mengirim kembali untuk verifikasi.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-privacy" role="tabpanel" aria-labelledby="v-pills-privacy-tab">
                                <h4 class="card-title mb-5">Logbook / Bukuputih harian</h4>
                                
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Pastikan sebelumnya anda mengisi data diri dengan baik</h5>
                                        <p class="text-muted">Terdapat pilihan <b>Jenis Logbook</b> pada isian data diri bagian <b>Status Kepegawaian</b>.Pastikan memilih Jenis Logbook yang sesuai dengan pangkat / golongan anda sesuai kebijakan RS.</p>
                                    </div>
                                </div>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Jangan Lupa Untuk Mengisi Logbook Tiap Hari</h5>
                                        <p class="text-muted">Jangan Lupa Untuk Mengisi data logbook tiap hari.Untuk memastikan data penilai kerja sesuai dengan kebijakan RS.</p>
                                    </div>
                                </div>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Masuk Bagian Laporan Untuk Melihat Data Logbook Secara Menyeluruh</h5>
                                        <p class="text-muted">Masuk bagian Logbook / Laporan untuk memastikan data logbook anda terisi dengan baik.Dan Unduh data jika dibutuhkan.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-support" role="tabpanel" aria-labelledby="v-pills-support-tab">
                                <h4 class="card-title mb-5">SPK Pengajuan</h4>
                            
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Cek data diri surat tanda registrasi</h5>
                                        <p class="text-muted">Cek Surat Tanda Registrasi dan lakukan pengajuan jika waktu kadaluarsa sudah dekat.</p>
                                    </div>
                                </div>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Lengkapi data Form Kredensial dan Form K3</h5>
                                        <p class="text-muted">Lengkapi data form kredensial untuk melakukan pengajuan setelahnya lengkapi juga form k3.</p>
                                    </div>
                                </div>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Pastikan data form kredensial di isi dengan data yang valid</h5>
                                        <p class="text-muted">Pastikan anda melengkapi data kredensial dengan baik dan lengkap , cek kembali dan pastikan tidak ada kesalahan.</p>
                                    </div>
                                </div>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Kirim data pengajuan untuk di Verifikasi</h5>
                                        <p class="text-muted">Setelah melengkapi data anda harus mengirim data pengajuan untuk di verifikasi oleh administrator kami.</p>
                                    </div>
                                </div>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Tunggu proses verifikasi</h5>
                                        <p class="text-muted">Tunggu Hingga admin selesai memproses konfirmasi data pengajuan anda sampai ada pemberitahuan ( notifikasi ).</p>
                                    </div>
                                </div>
                                <div class="faq-box d-flex">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-down-arrow-alt font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Perbaiki kesalahan jika data pengajuan di tolak</h5>
                                        <p class="text-muted">Anda dapat memperbaiki kesalahan input data diri jika di tolak dan bisa mengirim kembali untuk verifikasi.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    @endif


</x-app-layout>