<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // increase memory
        ini_set('memory_limit', '6000M');
        // disable database log to free up memory
        DB::disableQueryLog();
        // disable database events to free up memory
        DB::setEventDispatcher(new Dispatcher());

        $this->call([
            AdminSeeder::class,
            PaymentMethodSeeder::class,
            PlanSeeder::class,
            StoreSeeder::class,
            TagSeeder::class,
            TaggerSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            CustomerSeeder::class,
            HelpTicketSeeder::class,
            PageSeeder::class,
            OrderSeeder::class,
            CustomerReviewSeeder::class,
            StoreFeatureSeeder::class,
        ]);

        $this->call(WalletTransactionSeeder::class);
    }
}
