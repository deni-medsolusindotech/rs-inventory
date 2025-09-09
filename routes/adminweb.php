<?php

use App\Http\Controllers\ExportController;
use App\Http\Livewire\Admin\AdminPengajuanKebutuhan\AdminPengajuanKebutuhanDetail;
use App\Http\Livewire\Admin\AdminPengajuanKebutuhan\AdminPengajuanKebutuhanIndex;
use App\Http\Livewire\Admin\AdminPengajuanKerusakan\AdminPengajuanKerusakanDetail;
use App\Http\Livewire\Admin\AdminPengajuanKerusakan\AdminPengajuanKerusakanIndex;
use App\Http\Livewire\Admin\InputPengadaan\AdminInputPengadaanDetail;
use App\Http\Livewire\Admin\InputPengadaan\AdminInputPengadaanIndex;
use App\Http\Livewire\Admin\InputPengadaan\AdminInputPengadaanTambah;
use App\Http\Livewire\Admin\KategoriLokasi;
use App\Http\Livewire\Admin\LaporanFarmasi\AdminLaporanFarmasi;
use App\Http\Livewire\Admin\LaporanFarmasi\AdminLaporanFarmasiPengeluaran;
use App\Http\Livewire\Admin\RencanaBelanja\AdminRencanaBelanjaDetail;
use App\Http\Livewire\Admin\RencanaBelanja\AdminRencanaBelanjaIndex;
use App\Http\Livewire\Admin\StokOpname\AdminStokOpnameDetail;
use App\Http\Livewire\Admin\StokOpname\AdminStokOpnameIndex;
use App\Http\Livewire\DataUser\TableUsersRegistrasi;
use App\Http\Livewire\DataUser\UserDetail;
use App\Http\Livewire\Superadmin\DataAdmin\DataAdminDetail;
use App\Http\Livewire\Superadmin\DataAdmin\DataAdminIndex;
use App\Http\Livewire\Superadmin\DataAdmin\DataAdminTambah;
use App\Http\Livewire\SuperAdmin\HardcoreEdit;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:admin|super_admin','auth']],function (){
    // Data - User (admin & super admin)
    Route::get('/data-user',TableUsersRegistrasi::class);
    Route::get('/data-user/{email}/detail',UserDetail::class);
    
    Route::get('/input-pengadaan',AdminInputPengadaanIndex::class);
    Route::get('/input-pengadaan/tambah',AdminInputPengadaanTambah::class);
    Route::get('/input-pengadaan/detail/{id}',AdminInputPengadaanDetail::class);
    
    Route::get('/aproval-pengajuan',AdminPengajuanKebutuhanIndex::class);
    Route::get('/aproval-pengajuan/detail/{id}',AdminPengajuanKebutuhanDetail::class);
    
    Route::get('/aproval-rusak',AdminPengajuanKerusakanIndex::class);
    Route::get('/aproval-rusak/detail/{id}',AdminPengajuanKerusakanDetail::class);

    Route::get('/rencana-belanja',AdminRencanaBelanjaIndex::class);
    Route::get('/rencana-belanja/detail/{id}',AdminRencanaBelanjaDetail::class);

    Route::get('/stok-opname/export',[ExportController::class,'stokopname']);
    Route::get('/stok-opname',AdminStokOpnameIndex::class);
    Route::get('/stok-opname/detail/{id}',AdminStokOpnameDetail::class);
    
    Route::get('/laporan-stok-farmasi',AdminLaporanFarmasi::class);
    Route::get('/laporan-stok-farmasi-pengeluaran',AdminLaporanFarmasiPengeluaran::class);
    // Route::get('/stok-opname/detail/{id}',AdminStokOpnameDetail::class);

    Route::get('/edit-data-hardcore',HardcoreEdit::class);
    Route::get('/kategori-lokasi',KategoriLokasi::class);
});

Route::group(['middleware' => ['role:super_admin','auth']],function(){
    Route::get('/data-admin',DataAdminIndex::class);
    Route::get('/data-admin/{id}/detail',DataAdminDetail::class);
    Route::get('/data-admin/tambah',DataAdminTambah::class);

    
});

