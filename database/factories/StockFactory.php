<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Stock;

class StockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stock::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'product_id' => $this->faker->word(),
            'quantity' => $this->faker->numberBetween(-10000, 10000),
            'type' => $this->faker->randomElement(["purchase","adjustment","return"]),
            'created_at' => $this->faker->dateTime(),
        ];
    }
}
