<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('bikes', function (Blueprint $table) {
            $table->dropColumn(['components', 'weight']);
        });
    }

    public function down(): void
    {
        Schema::table('bikes', function (Blueprint $table) {
            $table->string('components')->nullable();
            $table->float('weight')->nullable();
        });
    }
};
