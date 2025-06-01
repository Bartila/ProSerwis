<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bikes', function (Blueprint $table) {
            $table->string('components')->nullable();
            $table->float('weight', 5, 2)->nullable(); // precyzyjniej: 999.99 kg
            $table->text('description')->nullable();
        });
    }

    public function down()
    {
        Schema::table('bikes', function (Blueprint $table) {
            $table->dropColumn(['components', 'weight', 'description']);
        });
    }
};
