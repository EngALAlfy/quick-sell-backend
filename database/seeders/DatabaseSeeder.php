<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ClientSeeder::class,
            SupplierSeeder::class,
            SaleSeeder::class,
        ]);


    }
}
