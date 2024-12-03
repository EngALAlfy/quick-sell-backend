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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class , "created_by_user_id")->nullable()->constrained("users")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignIdFor(\App\Models\Client::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('total_amount', 8, 2);
            $table->string('payment_method');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
