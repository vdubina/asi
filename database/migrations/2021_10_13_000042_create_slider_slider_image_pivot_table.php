<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderSliderImagePivotTable extends Migration
{
    public function up()
    {
        Schema::create('slider_slider_image', function (Blueprint $table) {
            $table->unsignedBigInteger('slider_image_id');
            $table->foreign('slider_image_id', 'slider_image_id_fk_5106263')->references('id')->on('slider_images')->onDelete('cascade');
            $table->unsignedBigInteger('slider_id');
            $table->foreign('slider_id', 'slider_id_fk_5106263')->references('id')->on('sliders')->onDelete('cascade');
        });
    }
}
