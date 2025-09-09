<?php

namespace Database\Seeders;

use App\Models\Pangkat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PangkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $pangkat = [
            ['Juru Muda','I','a'],
            ['Juru Muda Tingkat I','I','b'],
            ['Juru','I','c'],
            ['Juru Tingkat I','I','d'],
            ['Pengatur Muda','II','a'],
            ['Pengatur Muda Tingkat I','II','b'],
            ['Pengatur','II','c'],
            ['Pengatur Tingkat I','II','d'],
            ['Penata Muda','III','a'],
            ['Penata Muda Tingkat I','III','b'],
            ['Penata','III','c'],
            ['Penata Tingkat I','III','d'],
            ['Pembina ','IV','a'],
            ['Pembina Tingkat I','IV','b'],
            ['Pembina Utama Muda','IV','c'],
            ['Pembina Utama Madya','IV','d'],
            ['Pembina Utama','IV','e'],
        ];
        foreach($pangkat as $p){
            Pangkat::create([
                'pangkat' => $p[0],
                'golongan' => $p[1],
                'ruang' => $p[2],
            ]);
        }
    }
}
