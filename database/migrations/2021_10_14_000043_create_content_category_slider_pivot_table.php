<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentCategorySliderPivotTable extends Migration
{
    public function up()
    {
        Schema::create('content_category_slider', function (Blueprint $table) {
            $table->unsignedBigInteger('slider_id');
            $table->foreign('slider_id', 'slider_id_fk_5106254')->references('id')->on('sliders')->onDelete('cascade');
            $table->unsignedBigInteger('content_category_id');
            $table->foreign('content_category_id', 'content_category_id_fk_5106254')->references('id')->on('content_categories')->onDelete('cascade');
        });
    }
}
