<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CodeProduk>
 */
class CodeProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [ 
            'lokasi_id' => rand(1,10),
            'produk_id' =>rand(1,30),
            'jumlah_awal' =>rand(30,100),
            'jumlah_akhir' => 0,
            'tgl_pembelian' => now()
        ];
    }
}
