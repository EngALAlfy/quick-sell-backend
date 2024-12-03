<?php

namespace Database\Seeders;

use App\Enums\PaymentMethod;
use App\Enums\TransactionType;
use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Initialize Faker for realistic data
        $faker = Faker::create();
        $dates = [
            Carbon::now()->subDays(10),
        ];

        foreach ($dates as $date) {

        }

        // Fetch all clients and products
        $clients = Client::all();
        $products = Product::where(function ($query) {
            $query->where('enable_stock', true)
                ->where('stock_quantity', '>', 0);
        })->orWhere('enable_stock', false)->get();

        if ($clients->isEmpty()) {
            $this->command->info('No clients found. Please seed clients before running SaleSeeder.');
            return;
        }

        if ($products->isEmpty()) {
            $this->command->info('No products found. Please seed products before running SaleSeeder.');
            return;
        }

        // Number of sales to create
        $numberOfSales = 50; // Adjust as needed

        for ($i = 0; $i < $numberOfSales; $i++) {
            // Select a random client
            $client = $clients->random();

            // Select a random payment method
            $paymentMethod = PaymentMethod::cases()[array_rand(PaymentMethod::cases())]->value;

            // Create a sale
            $sale = Sale::create([
                'client_id' => $client->id,
                'payment_method' => $paymentMethod,
                'total_amount' => 0, // Will update after adding items
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            // Determine number of items in this sale
            $itemsCount = rand(1, 5);

            $totalAmount = 0;

            for ($j = 0; $j < $itemsCount; $j++) {
                // Select a random product
                $product = $products->random();

                // Determine quantity
                if ($product->enable_stock) {
                    $maxQuantity = $product->stock_quantity >= 10 ? 10 : $product->stock_quantity;
                    $quantity = rand(1, $maxQuantity);
                } else {
                    $quantity = rand(1, 20);
                }

                // Calculate price
                $price = $product->sell_price;

                // Create sale item
                $saleItem = $sale->saleItems()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);

                // Update total amount
                $totalAmount += $price * $quantity;

                // Update product stock if applicable
                if ($product->enable_stock) {
                    $product->decrement('stock_quantity', $quantity);
                }

                // Create transaction
                Transaction::create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'amount' => $price * $quantity,
                    'type' => TransactionType::sell->value,
                    'transactable_id' => $sale->id,
                    'transactable_type' => Sale::class,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }

            // Update the total amount for the sale
            $sale->update(['total_amount' => $totalAmount, 'updated_at' => $date]);
        }

        $this->command->info("Successfully seeded {$numberOfSales} sales with sale items and transactions.");
    }
}
