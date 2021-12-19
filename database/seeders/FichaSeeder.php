<?php

namespace Database\Seeders;

use App\Models\Capitulo;
use App\Models\Ficha;
use App\Models\Role;
use Illuminate\Database\Seeder;

class FichaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fichas = Ficha::factory(50)->create();
        
        foreach ($fichas as $ficha) {
           $ficha->roles()->attach(Role::all()->random());
            $capitulos = Capitulo::factory(3)->create([
                'ficha_id' => $ficha->id,
                
            ]);
            $i=0;
            foreach ($capitulos as $capitulo) {
                $capitulo->order = $i++;
            }
        }
    }
}
