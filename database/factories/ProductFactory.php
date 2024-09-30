<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_en' => $this->faker->words(5, true),
            'slug' => $this->faker->words(1, true),
            'category_id' => Category::inRandomOrder()->first()->id,
            'regular_price' => (double) $this->faker->numerify( '####' ),
        ];
    }
}
