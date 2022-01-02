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
            'name' => 'Seinaleak / Señalización',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones de un determinado elemento que interviene en los sistemas Señalización.',
            'description_eu' => 'Seinaleztapen-sistemetan esku hartzen duen elementu jakin baten ezaugarriak edo funtzioak deskribatzen, zabaltzen, azaltzen edo zehazten dituzten fitxak.',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);

        Category::create([
            'code' => 'COM',
            'name' => 'Komunikazioak / Comunicaciones',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones de un determinado elemento que interviene en los sistemas Comunicaciones.',
            'description_eu' => 'Komunikazio-sistemetan esku hartzen duen elementu jakin baten ezaugarriak edo funtzioak deskribatzen, zabaltzen, azaltzen edo zehazten dituzten fitxak.',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);

        Category::create([
            'code' => 'ATP',
            'name' => 'Frenatze automatikoko sistema / Sistema de Frenado Automatico',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones del ATP',
            'description_eu' => 'ATPren ezaugarriak edo funtzioak deskribatzen, zabaltzen, azaltzen edo zehazten dituzten fitxak',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);
        Category::create([
            'code' => 'ENG',
            'name' => 'Energia / Energía',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones de un determinado elemento que interviene en los sistemas Energía.',
            'description_eu' => 'Energia sistemetan esku hartzen duen elementu jakin baten ezaugarriak edo funtzioak deskribatzen, zabaltzen, azaltzen edo zehazten dituzten fitxak.',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);
        Category::create([
            'code' => 'INS',
            'name' => 'Instalazioak / Instalaciones',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones de diferentes Instalaciones.',
            'description_eu' => 'Hainbat instalazioren ezaugarriak edo funtzioak deskribatzen, zabaltzen, azaltzen edo zehazten dituzten fitxak.',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);
        Category::create([
            'code' => 'OPE',
            'name' => 'Eragiketa / Operación',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones en la operación.',
            'description_eu' => 'Eragiketaren ezaugarriak edo funtzioak deskribatzen, zabaltzen, azaltzen edo zehazten dituzten fitxak.',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);
        Category::create([
            'code' => 'PLA',
            'name' => 'Planifikazio / Planificación',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones de la planificación del servicio.',
            'description_eu' => 'Zerbitzuaren plangintzaren ezaugarriak edo funtzioak deskribatzen, zabaltzen, azaltzen edo zehazten dituzten fitxak.',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);

        Category::create([
            'code' => 'T-ES',
            'name' => 'Geltokietako teleagintea / Telemando Estaciones',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones del telemando de estaciones.',
            'description_eu' => 'Estazioetako teleagintearen ezaugarriak edo funtzioak deskribatzen, zabaltzen, azaltzen edo zehazten dituzten fitxak.',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);

        Category::create([
            'code' => 'CTC-S',
            'name' => 'CTC Siemens',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones del CTC de Siemens.',
            'description_eu' => 'Siemens-en CTCren ezaugarriak edo funtzioak deskribatzen, zabaltzen, azaltzen edo zehazten dituzten fitxak.',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);

        Category::create([
            'code' => 'CTC-T',
            'name' => 'CTC-1000 Thales',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones del CTC de Thales',
            'description_eu' => 'Thalesen CTCren ezaugarriak edo funtzioak deskribatzen, zabaltzen, azaltzen edo zehazten dituzten fitxak',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);

        Category::create([
            'code' => 'AGS',
            'name' => 'AGS GMV',
            'description' => 'Fichas que describen, amplian,  explican o detallan caracteristicas o funciones del AGS de GMV',
            'description_eu' => 'GMVren AGSaren ezaugarriak edo funtzioak deskribatzen, zabaltzen, azaltzen edo zehazten dituzten fitxak',
            'image' => $faker->imageUrl($width = 500, $height = 200 , 'technics')
        ]);
    }
    
    
}

