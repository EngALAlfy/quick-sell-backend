<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table("products")->truncate();
        Schema::enableForeignKeyConstraints();

        Product::create([
            "name" => "حليب",
            "description" => "حليب طازج 1 لتر",
            "category_id" => Category::query()->inRandomOrder()->value("id"),
            "purchase_price" => 8,
            "sell_price" => 10,
            "enable_stock" => true,
            "stock_quantity" => 10,
            "sku" => 100001,
        ]);

        Product::create([
            "name" => "جبنة بيضاء",
            "description" => "جبنة بيضاء 500 جرام",
            "category_id" => Category::query()->inRandomOrder()->value("id"),
            "purchase_price" => 15,
            "sell_price" => 18,
            "enable_stock" => true,
            "stock_quantity" => 10,
            "sku" => 100002,
        ]);

        Product::create([
            "name" => "تفاح أحمر",
            "description" => "تفاح أحمر مستورد 1 كجم",
            "category_id" => Category::query()->inRandomOrder()->value("id"),
            "purchase_price" => 12,
            "sell_price" => 15,
            "enable_stock" => true,
            "stock_quantity" => 10,
            "sku" => 100003,
        ]);

        Product::create([
            "name" => "عصير برتقال",
            "description" => "عصير برتقال طبيعي 500 مل",
            "category_id" => Category::query()->inRandomOrder()->value("id"),
            "purchase_price" => 6,
            "sell_price" => 8,
            "enable_stock" => true,
            "stock_quantity" => 10,
            "sku" => 100004,
        ]);

        Product::create([
            "name" => "طماطم",
            "description" => "طماطم طازجة 1 كجم",
            "category_id" => Category::query()->inRandomOrder()->value("id"),
            "purchase_price" => 3,
            "sell_price" => 5,
            "enable_stock" => true,
            "stock_quantity" => 10,
            "sku" => 100005,
        ]);

        Product::create([
            "name" => "لحم بقر",
            "description" => "لحم بقر طازج 1 كجم",
            "category_id" => Category::query()->inRandomOrder()->value("id"),
            "purchase_price" => 45,
            "sell_price" => 50,
            "enable_stock" => true,
            "stock_quantity" => 10,
            "sku" => 100006,
        ]);

        Product::create([
            "name" => "زيت زيتون",
            "description" => "زيت زيتون بكر ممتاز 500 مل",
            "category_id" => Category::query()->inRandomOrder()->value("id"),
            "purchase_price" => 20,
            "sell_price" => 25,
            "enable_stock" => true,
            "stock_quantity" => 10,
            "sku" => 100007,
        ]);

        Product::create([
            "name" => "بيض",
            "description" => "بيض بلدي 12 بيضة",
            "category_id" => Category::query()->inRandomOrder()->value("id"),
            "purchase_price" => 10,
            "sell_price" => 12,
            "enable_stock" => true,
            "stock_quantity" => 10,
            "sku" => 100008,
        ]);

        Product::create([
            "name" => "عسل نحل",
            "description" => "عسل نحل طبيعي 250 جرام",
            "category_id" => Category::query()->inRandomOrder()->value("id"),
            "purchase_price" => 30,
            "sell_price" => 35,
            "enable_stock" => true,
            "stock_quantity" => 10,
            "sku" => 100009,
        ]);

        Product::create([
            "name" => "مكرونة",
            "description" => "مكرونة إيطالية 1 كجم",
            "category_id" => Category::query()->inRandomOrder()->value("id"),
            "purchase_price" => 5,
            "sell_price" => 7,
            "enable_stock" => false,
            "sku" => 100010,
        ]);
    }
}
