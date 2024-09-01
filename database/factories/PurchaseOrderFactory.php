<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PurchaseOrder;

class PurchaseOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PurchaseOrder::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'supplier_id' => $this->faker->word(),
            'total_amount' => $this->faker->randomFloat(2, 0, 999999.99),
            'status' => $this->faker->randomElement(["pending","received","canceled"]),
            'created_at' => $this->faker->dateTime(),
        ];
    }
}
