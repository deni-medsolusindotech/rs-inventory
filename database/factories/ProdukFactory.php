<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {   
        
        $nama = fake()->unique()->sentence(1).' ' .Str::random(rand(1,5));
        return [
            'nama_barang' => $nama,
            'slug' => Str::slug($nama,'-'),
            'kategori_id' => rand(1,10),
            'harga'       => rand(1,1000) .'000',
            'merk'  => fake()->sentence(1),
            'spesifikasi'  => fake()->sentence(1),
            'keterangan'  => fake()->sentence(1),
            'gambar'  => fake()->sentence(1),
        ];
    }
}
