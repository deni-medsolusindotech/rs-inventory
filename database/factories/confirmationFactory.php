<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\confirmation>
 */
class confirmationFactory extends Factory
{
   
    public function definition()
    {
        return [
            'user_id' => rand(1,4),
            'table' => 'StokMasuk',
            'keterangan' => ''
        ];
    }
}
