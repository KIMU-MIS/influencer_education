

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculums', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('thumbnail')->nullable();
            $table->longText('description')->nullable();
            $table->mediumText('video_url')->nullable();
            $table->tinyInteger('alway_delivery_flg');
            $table->unsignedBigInteger('grade_id');
            $table->timestamps();
            //外部キー制約
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curriculums');
    }
};
