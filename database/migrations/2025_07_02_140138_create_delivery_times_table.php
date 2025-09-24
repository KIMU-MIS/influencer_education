<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('delivery_times', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('curriculums_id');
            $table->dateTime('delivery_from');
            $table->dateTime('delivery_to');
            $table->string('status')->default('pending'); 
            $table->boolean('always_open')->default(false);
            $table->timestamps();

        $table->foreign('curriculums_id')
            ->references('id')
            ->on('curriculums')
            ->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('delivery_times');
    }
};
