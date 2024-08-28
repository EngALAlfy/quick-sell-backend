<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->json("title")->after("name");
            $table->foreignId('group_id')->after("guard_name")->constrained()->on("permission_groups")->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('group_id');
            $table->dropColumn('title');
        });
    }
};
