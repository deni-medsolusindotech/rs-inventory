<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notify>
 */
class NotifyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {   
        $icon = ['alert','information','account-alert','clipboard-edit','file','store','cart-check','cart-off'];
        $status = ['warning','primary','danger','info','secondary'];
        return [
            'user_id' => 1,
            'link'    => '/notifikasi',
            'icon'    => $icon[rand(1,7)],
            'status'  => $status[rand(1,4)],
            'tittle'  => fake()->sentence(),
            'body'    => fake()->sentence(10),
            'show'    => rand(0,2)
        ];
    }
}
