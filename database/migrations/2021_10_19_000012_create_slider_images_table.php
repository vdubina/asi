<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderImagesTable extends Migration
{
    public function up()
    {
        Schema::create('slider_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->longText('page_text')->nullable();
            $table->integer('field_weight')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
