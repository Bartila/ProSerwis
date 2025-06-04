<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // kto wykonał akcję
            $table->string('action'); // np. 'add', 'edit', 'delete', 'status_change', 'user_create'
            $table->string('model_type')->nullable(); // np. 'Bike', 'User'
            $table->unsignedBigInteger('model_id')->nullable(); // ID obiektu
            $table->text('description')->nullable(); // opis akcji
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
