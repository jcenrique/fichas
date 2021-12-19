<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Orchid\Support\Facades\Dashboard;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'slug' => 'admin',
            'permissions' => Dashboard::getAllowAllPermission(),
        ]);
        Role::create([
            'name' => 'Jefe de Servicio Bizkaia',
            'slug' => 'jefe-servicio-bizkaia',
            'permissions' => ['home' => true],

        ]);
        Role::create([
            'name' => 'Jefe de Servicio Gipuzkoa',
            'slug' => 'jefe-servicio-gipuzkoa',
            'permissions' => ['home' => true],

        ]);
        Role::create([
            'name' => 'Técnico PM Bizkaia',
            'slug' => 'tecnico-pm-bizkaia',
            'permissions' => ['home' => true],

        ]);
        Role::create([
            'name' => 'Técnico PM  Gipuzkoa',
            'slug' => 'tecnico-pm-gipuzkoa',
            'permissions' => ['home' => true],
        ]);
        Role::create([
            'name' => 'Técnico Red Bizkaia',
            'slug' => 'tecnico-red-bizkaia',
            'permissions' => ['home' => true],

        ]);
        Role::create([
            'name' => 'Técnico Red Gipuzkoa',
            'slug' => 'tecnico-red-gipuzkoa',
            'permissions' => ['home' => true],

        ]);
        Role::create([
            'name' => 'Invitado',
            'slug' => 'invitado',
            'permissions' => ['home' => true],

        ]);
    }
}
