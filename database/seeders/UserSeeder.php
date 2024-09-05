<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Schema::disableForeignKeyConstraints();

        DB::table("users")->truncate();

        Schema::enableForeignKeyConstraints();

        User::factory()->count(1)->create([
            "email" => "config@mail.com",
        ]);

        User::factory()->count(1)->create([
            "email" => "admin@mail.com",
        ]);

        User::factory()->count(1)->create([
            "email" => "demo@mail.com",
        ]);
    }
}
