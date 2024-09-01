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
            $table->enum('transaction_type', ["sale","purchase","stock"]);
            $table->string('user_id');
            $table->unsignedBigInteger('transactable_id');
            $table->string('transactable_type');
            $table->decimal('amount', 8, 2);
            $table->json('details')->nullable();
            $table->morphs('transactable');
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
