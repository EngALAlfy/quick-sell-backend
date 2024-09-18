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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class , "created_by_user_id")->nullable()->constrained("users")->cascadeOnUpdate()->nullOnDelete();
            $table->string('type');
            $table->decimal('amount', 8, 2);
            $table->integer('quantity');
            $table->json('details')->nullable();
            $table->foreignIdFor(\App\Models\Product::class);
            $table->nullableMorphs('transactable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
