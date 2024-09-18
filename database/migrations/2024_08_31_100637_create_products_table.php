<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('sku', 100)->unique();
            $table->decimal('purchase_price', 8, 2);
            $table->decimal('sell_price', 8, 2);

            $table->boolean('enable_stock')->default(true);
            $table->integer('alert_quantity')->nullable();
            $table->integer('stock_quantity')->nullable();
            $table->string('status')->default("active");

            $table->text('description')->nullable();
            $table->foreignIdFor(\App\Models\Category::class);
            $table->foreignIdFor(\App\Models\User::class , "created_by_user_id")->nullable()->constrained("users")->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
