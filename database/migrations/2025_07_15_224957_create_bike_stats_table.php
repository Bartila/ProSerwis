<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateBikeStatsTable extends Migration
{
    public function up()
    {
        Schema::create('bike_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('total_added')->default(0);
            $table->timestamps();
        });

        DB::table('bike_stats')->insert([
            'total_added' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('bike_stats');
    }
}
