<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\kategori>
 */
class kategoriFactory extends Factory
{
   
    public function definition()
    {
        return [
           'nama_kategori' => fake()->unique()->sentence(1)
        ];
    }
}
