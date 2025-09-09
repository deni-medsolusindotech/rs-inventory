<?php

use App\Http\Controllers\ExportController;
use App\Http\Livewire\User\Farmasi\UserFarmasiStok;
use App\Http\Livewire\User\Farmasi\UserFarmasiStokTambah;
use App\Http\Livewire\User\PengajuanKebutuhan\UserPengajuanKebutuhan;
use App\Http\Livewire\User\PengajuanKebutuhan\UserPengajuanKebutuhanDetail;
use App\Http\Livewire\User\PengajuanKebutuhan\UserPengajuanKebutuhanTambah;
use App\Http\Livewire\User\PengajuanKerusakan\UserPengajuanKerusakanDetail;
use App\Http\Livewire\User\PengajuanKerusakan\UserPengajuanKerusakanIndex;
use App\Http\Livewire\User\PengajuanKerusakan\UserPengajuanKerusakanTambah;
use App\Http\Livewire\User\UserDaftarBarang;
use App\Http\Livewire\User\UserDaftarBarang\UserDaftarBarangDetail;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:super_admin|admin|igd|radiologi|farmasi|laboratorium|poli_gigi|toilet_karyawan|poli_obgyn|kesling|cssd|toilet|ruang_oksigen|gizi|dapur|ruang_dokter|vk|konseling_obat_ppip|rekam_medik|poli_bedah|poli_anak|toilet_1|poli_dalam|ruang_rapat|ruang_kasubag_tu|ruang_kasubag_penunjang_medik|ruang_kasubag_pelayanan_medik|ruang_direktur|ruang_server|ruang_management|tulip_kelas_1|ruang_jaga|asoka_dewasa_laki-laki_kelas_3|lotus_dewasa_perempuan_kelas_3|toilet_perempuan|toilet_laki-laki|lily_ruang_anak_kelas_3|lavender_ruang_nifas_kelas_3|ruang_isolasi|dahlia_kelas_2|ruang_icu|ok','auth']],function (){
   
    Route::get('daftar-barang/detail/{id}',UserDaftarBarangDetail::class);
    Route::get('daftar-barang',UserDaftarBarang::class);
    
    Route::get('stok-opname-farmasi',UserFarmasiStok::class);
    Route::get('/stok-opname-farmasi/tambah',UserFarmasiStokTambah::class);

    Route::get('/daftar-barang/export',[ExportController::class,'stokopname']);

    Route::get('pengajuan-kebutuhan',UserPengajuanKebutuhan::class);
    Route::get('pengajuan-kebutuhan/detail/{id}',UserPengajuanKebutuhanDetail::class);
    Route::get('pengajuan-kebutuhan-tambah',UserPengajuanKebutuhanTambah::class);

    Route::get('pengajuan-kerusakan',UserPengajuanKerusakanIndex::class);
    Route::get('pengajuan-kerusakan/detail/{id}',UserPengajuanKerusakanDetail::class);
    Route::get('pengajuan-kerusakan-tambah',UserPengajuanKerusakanTambah::class);
});
