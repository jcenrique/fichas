<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'code' => 'SEÑ',
            'name' => 'Señalización',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones de un determinado elemento que interviene en los sistemas Señalización ',
            'image' => $this->faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);

        Category::create([
            'code' => 'COM',
            'name' => 'Comunicaciones',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones de un determinado elemento que interviene en los sistemas Comunicaciones ',
            'image' => $this->faker->imageUrl($width = 500, $height = 200, 'technics')
        ]);

        Category::create([
            'code' => 'ATP',
            'name' => 'Sistema de Frenado Automatico',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones del ATP',
            'image' => $this->faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);
    }
    }
}

