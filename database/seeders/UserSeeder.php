<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        //cargar usuarios ldap ficticios
    //    Artisan::call('ldap:import',['provider' => 'ldap', '--no-interaction']);
     
    //    $users = User::all();
    //    foreach ($users as $user) {
    //        $user->addRole(Role::all()->random());
    //    }

       //crear usuario admin
       Artisan::call('orchid:admin' , ['name' => 'admin' , 'email' => 'jcenrique170@gmail.com' , 'password' => '1234qwer']);
       $user = User::where('email', '=' ,'jcenrique170@gmail.com')->first();
       $user->addRole(Role::where('slug', '=','admin')->first());


    }
}
