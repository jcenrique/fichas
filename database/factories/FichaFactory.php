<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FichaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = Category::all()->random();
        
        $data =[
            'category_id' =>  $category->id,
            'user_id' =>  User::all()->random()->id,
            'code' => $category->num . '-' . $category->code,
            'title' => $this->faker->sentence(4,  true),
            'description' => $this->faker->paragraph( 3, true),
            'status' =>   $this->faker->randomElement([0 ,1]),
            
        ];
        $category->increment('num');

        return  $data;
       
    }
}
