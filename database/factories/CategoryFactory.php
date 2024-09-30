<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_en' => $this->faker->name,
            'description_en' => $this->faker->text,
            'parent_id' => $this->faker->randomNumber(1,2),
            'type' => $this->faker->randomNumber(1,2),
            'is_featured' => $this->faker->randomNumber(1,2),
            'status' => $this->faker->randomNumber(1,2),
            'slug' => Str::slug($this->faker->name),
        ];
    }
}
