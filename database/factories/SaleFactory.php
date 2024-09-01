<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Sale;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->word(),
            'total_amount' => $this->faker->randomFloat(2, 0, 999999.99),
            'payment_method' => $this->faker->randomElement(["cash","credit_card"]),
            'created_at' => $this->faker->dateTime(),
        ];
    }
}
