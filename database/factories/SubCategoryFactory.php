<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_en' => $this->faker->words(2, true),
            'slug' => $this->faker->words(2, true),
            'parent_id' => Category::inRandomOrder()->first()->id,
            'type' => 2,
        ];
    }
}
