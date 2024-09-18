<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("categories")->truncate();

        Category::create([
            "name" => "البان",
            "description" => "",
        ]);
        Category::create([
            "name" => "خضروات",
            "description" => "",
        ]);
        Category::create([
            "name" => "فواكه",
            "description" => "",
        ]);
        Category::create([
            "name" => "لحوم",
            "description" => "",
        ]);
        Category::create([
            "name" => "عصائر",
            "description" => "",
        ]);
    }
}
