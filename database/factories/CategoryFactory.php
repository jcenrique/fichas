<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{


   
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->unique()->sentence(2, true) ,
            'code' => $this->faker->unique()->lexify('????'),
            'description' => $this->faker->text( 200) ,
            'image' => $this->faker->imageUrl($width = 500, $height = 200) 
        ];
    }
}
