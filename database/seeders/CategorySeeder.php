<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Container\Container;

class CategorySeeder extends Seeder
{

  


     

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
      
        Category::create([
            'code' => 'SEÑ',
            'name' => 'Señalización',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones de un determinado elemento que interviene en los sistemas Señalización ',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);

        Category::create([
            'code' => 'COM',
            'name' => 'Comunicaciones',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones de un determinado elemento que interviene en los sistemas Comunicaciones ',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);

        Category::create([
            'code' => 'ATP',
            'name' => 'Sistema de Frenado Automatico',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones del ATP',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);
        Category::create([
            'code' => 'ENG',
            'name' => 'Energía',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones de un determinado elemento que interviene en los sistemas Energía ',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);
        Category::create([
            'code' => 'INS',
            'name' => 'Instalaciones',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones de diferentes Instalaciones',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);
        Category::create([
            'code' => 'OPE',
            'name' => 'Operación',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones en la operación',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);
        Category::create([
            'code' => 'PLA',
            'name' => 'Planificación',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones de la planificación del servicio',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);

        Category::create([
            'code' => 'T-ES',
            'name' => 'Telemando Estaciones',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones del telemando de estaciones',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);

        Category::create([
            'code' => 'CTC-S',
            'name' => 'CTC Siemens',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones del CTC de Siemens',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);

        Category::create([
            'code' => 'CTC-T',
            'name' => 'CTC-1000 Thales',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones del CTC de Thales',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);

        Category::create([
            'code' => 'AGS',
            'name' => 'AGS GMV',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones del AGS de GMV',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);
    }
    
    
}

