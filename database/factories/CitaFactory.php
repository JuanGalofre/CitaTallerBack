<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cita>
 */
class CitaFactory extends Factory
{

    public function definition(): array
    {
        //Depende de que existan usuarios
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'hora' => $this->faker->time(), 
            'fecha' => $this->faker->date(), 
            'descripcion' => $this->faker->text(), 
            'estado' => $this->faker->randomElement(['pendiente', 'confirmada', 'cancelada']), 
        ];
    }
}
