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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->string('password', 400);
            $table->dateTime('email_verified_at')->nullable();
            $table->dateTime('last_login_datetime')->nullable();
            $table->string('last_login_os', 50)->nullable();
            $table->ipAddress('last_login_ip')->nullable();
            $table->text('last_login_useragent')->nullable();
            $table->string('status')->default('active');
            $table->unsignedBigInteger('status_by')->nullable()->default(0);
            $table->dateTime('status_datetime')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
