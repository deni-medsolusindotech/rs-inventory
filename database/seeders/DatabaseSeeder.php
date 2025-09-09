<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\codeproduk;
use App\Models\kategori;
use App\Models\Lokasi;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {   
        $role = ['super_admin','admin','igd','radiologi','farmasi','laboratorium','poli_gigi','toilet_karyawan','poli_obgyn','kesling','cssd','toilet','ruang_oksigen','gizi','dapur','ruang_dokter','vk','konseling_obat_ppip','rekam_medik','poli_bedah','poli_anak','toilet_1','poli_dalam','ruang_rapat','ruang_kasubag_tu','ruang_kasubag_penunjang_medik','ruang_kasubag_pelayanan_medik','ruang_direktur','ruang_server','ruang_management','tulip_kelas_1','ruang_jaga','asoka_dewasa_laki-laki_kelas_3','lotus_dewasa_perempuan_kelas_3','toilet_perempuan','toilet_laki-laki','lily_ruang_anak_kelas_3','lavender_ruang_nifas_kelas_3','ruang_isolasi','dahlia_kelas_2','ruang_icu','ok',];

        foreach($role as $name_role){
            Lokasi::create(['nama_lokasi' => $name_role]);
            $role = Role::create(['name' => $name_role]);
            $user = User::factory()->create([
                'name' =>  $name_role,
                'email' =>  $name_role,
                'password' => 'password'
            ]);
            $user->assignRole($name_role);
        }


        $adminrole = Role::findByName('admin');
        $superadminrole = Role::findByName('super_admin');
        $farmasirole = Role::findByName('farmasi');
        $usersrole = Role::whereNotIn('name',['super_admin','admin'])->get();


        $permission = [
                    'all produk','akun','aproval','laporan','input pengadaan','pengajuan kebutuhan',
                    'pengajuan kerusakan','stok opname farmasi'
                    ];

        foreach($permission as $name_permission){
            $role = Permission::create(['name' => $name_permission]);
        }


        $admin = ['all produk','aproval','laporan','input pengadaan'];
        $superadmin = ['akun',];
        $users = ['pengajuan kebutuhan','pengajuan kerusakan'];
        $farmasi = ['stok opname farmasi'];
      
        Role::findByName('super_admin')->givePermissionTo($admin);
        Role::findByName('farmasi')->givePermissionTo($farmasi);

        $adminrole->givePermissionTo($admin);
        $superadminrole->givePermissionTo($admin);
        $superadminrole->givePermissionTo($superadmin);
        foreach($usersrole as $role){
            $role->givePermissionTo($users);
        }
        $farmasirole->givePermissionTo($farmasi);
       

        // kategori::factory(10)->create();
        // Produk::factory(30)->create();
        // codeproduk::factory(30)->create();
    }
}
