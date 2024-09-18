<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Transaction;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'transaction_type' => $this->faker->randomElement(["sale","purchase","stock"]),
            'transactable_id' => $this->faker->randomNumber(),
            'transactable_type' => $this->faker->word(),
            'amount' => $this->faker->randomFloat(2, 0, 999999.99),
            'details' => '{}',
        ];
    }
}
