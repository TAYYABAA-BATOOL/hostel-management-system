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
    Schema::create('rooms', function (Blueprint $table) {
    $table->id();
    $table->string('room_no')->unique();
    $table->string('type')->default('Single'); // Single, Double, etc.
    $table->integer('capacity')->default(1);
    $table->integer('occupied')->default(0);
    $table->string('status')->default('Available'); // Available, Occupied, Partial
    $table->timestamps();
   

});

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
