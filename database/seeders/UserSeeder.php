<?php

namespace Database\Seeders;

use App\Models\Cita;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = User::factory()->count(100)->create();
        $usuarios->each( function($usuario){
            
            //Los argumentos dentro del create hacen un override.
            Cita::factory()->count(rand(1, 5))->create([
                'user_id' => $usuario->id, 
            ]);
        });

    }
}
