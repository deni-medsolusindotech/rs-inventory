<div id="sidebar-menu">
    @role(['igd','radiologi','farmasi','laboratorium','poli_gigi','toilet_karyawan','poli_obgyn','kesling','cssd','toilet','ruang_oksigen','gizi','dapur','ruang_dokter','vk','konseling_obat_ppip','rekam_medik','poli_bedah','poli_anak','toilet_1','poli_dalam','ruang_rapat','ruang_kasubag_tu','ruang_kasubag_penunjang_medik','ruang_kasubag_pelayanan_medik','ruang_direktur','ruang_server','ruang_management','tulip_kelas_1','ruang_jaga','asoka_dewasa_laki-laki_kelas_3','lotus_dewasa_perempuan_kelas_3','toilet_perempuan','toilet_laki-laki','lily_ruang_anak_kelas_3','lavender_ruang_nifas_kelas_3','ruang_isolasi','dahlia_kelas_2','ruang_icu','ok',]) 
        <!-- User Perawat atau bidan -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title" key="t-menu">Menu</li>
            <li>
                <a href="/dashboard" class="waves-effect">
                    <i class="bx bx-home-circle"></i>
                    <span key="t-calendar">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/daftar-barang" class="waves-effect">
                    <i class="bx bx-box"></i>
                    <span key="t-calendar">Daftar Barang</span>
                </a>
            </li>
            <li>
                <a href="/pengajuan-kebutuhan" class="waves-effect">
                    <i class="bx bx-upload"></i>
                    <span key="t-calendar">Pengajuan Kebutuhan</span>
                </a>
            </li>
            <li>
                <a href="/pengajuan-kerusakan" class="waves-effect">
                    <i class="bx bx-receipt"></i>

                    <span key="t-calendar">Pengajuan Kerusakan</span>
                </a>
            </li>
            @role('farmasi')
                <li>
                    <a href="/stok-opname-farmasi" class="waves-effect">
                        <i class="bx bx-detail"></i>
                        <span key="t-calendar">Stok</span>
                    </a>
                </li>
            @endrole
            <li>
                <a href="/riwayat" class="waves-effect">
                    <i class="bx bx-history"></i>
                    <span key="t-chat">Riwayat</span>
                </a>
            </li>
        
            {{-- <li>
                <a href="/panduan" class="waves-effect">
                    <i class="bx bx-list-ol"></i>
                    <span key="t-chat">Panduan</span>
                </a>
            </li> --}}

        </ul>
    @endrole

    @role(['admin','super_admin'])
        <!-- User Admin atau Super Admin -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title" key="t-menu">Menu</li>
            <li>
                <a href="/dashboard" class="waves-effect">
                    <i class="bx bx-home-circle"></i>
                    <span key="t-calendar">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/input-pengadaan" class="waves-effect">
                    <i class="bx bx-edit"></i>
                    <span key="t-calendar">Input Pengadaan</span>
                </a>
            </li>
            <li>
                <a href="/aproval-pengajuan" class="waves-effect">
                    <i class="bx bx-download"></i>
                    <span key="t-calendar">Aproval Pengajuan</span>
                </a>
            </li>
            <li>
                <a href="/rencana-belanja" class="waves-effect">
                    <i class='bx bx-cart-alt'></i>
                    <span key="t-calendar">Data Rencana Belanja</span>
                </a>
            </li>
            <li>
                <a href="/aproval-rusak" class="waves-effect">
                    <i class="bx bx-info-circle"></i>
                    <span key="t-calendar">Aproval Rusak / Hilang</span>
                </a>
            </li>
            <li>
                <a href="/stok-opname" class="waves-effect">
                    <i class="bx bx-file"></i>
                    <span key="t-calendar">Stok Opname</span>
                </a>
            </li>
         
            <li>
                <a href="/laporan-stok-farmasi" class="waves-effect">
                    <i class="bx bx-export"></i>
                    <span key="t-calendar">Laporan Stok Farmasi</span>
                </a>
            </li>
            
            <li>
                <a href="/kategori-lokasi" class="waves-effect">
                    <i class="bx bx-map-pin"></i>
                    <span key="t-calendar">Kategori & Lokasi</span>
                </a>
            </li>
           
            @role('super_admin')
                <li>
                    <a href="/data-admin" class="waves-effect">
                        <i class="bx bxs-user-detail"></i>
                        <span key="t-calendar">Data User</span>
                    </a>
                </li>
                <li>
                    <a href="/edit-data-hardcore" class="waves-effect">
                        <i class="bx bx-edit"></i>
                        <span key="t-calendar">Edit Data <small class="text-danger">( tidak disarankan ) </small> </span>
                    </a>
                </li>
            @endrole
            <li>
                <a href="/feedback" class="waves-effect">
                    <i class="bx bx-chat"></i>
                    <span key="t-chat">Feedback</span>
                </a>
            </li>
            <li>
                <a href="/riwayat" class="waves-effect">
                    <i class="bx bx-history"></i>
                    <span key="t-chat">Riwayat</span>
                </a>
            </li>
            {{-- <li>
                <a href="/panduan" class="waves-effect">
                    <i class="bx bx-list-ol"></i>
                    <span key="t-chat">Panduan</span>
                </a>
            </li> --}}

        </ul>
    @endrole

</div>



@if(!auth()->user()->confirm)
<script>
    $('#data-diri').on('click',function(){

        Swal.fire({
            title: "Mohon Maaf",
            text: "Data user anda belum dikonfirmasi untuk menggunakan fitur ini",
            icon: "warning",
            showCancelButton: false,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
        });
    })
</script>
@endif

@if(auth()->user()->status_verifikasi != 'terima')
<script>
    function unconfirmed(){
        Swal.fire({
            title: "Mohon Maaf",
            text: "Data diri anda belum dikonfirmasi untuk menggunakan fitur ini",
            icon: "warning",
            showCancelButton: false,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Lihat Profil",
        }).then((result) => {
            if (result.isConfirmed) {
                Turbolinks.visit('/profile');
            }
        });
    }
</script>
@endif