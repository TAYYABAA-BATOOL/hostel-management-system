<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticesTable extends Migration
{
    public function up()
{
    Schema::create('notices', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->string('status')->default('Active');
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('notices');
    }
}
