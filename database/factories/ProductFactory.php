<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;

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
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'sku' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'price' => $this->faker->randomFloat(2, 0, 999999.99),
            'description' => $this->faker->text(),
            'category_id' => Category::factory(),
        ];
    }
}
