<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimonialTestimonialTypePivotTable extends Migration
{
    public function up()
    {
        Schema::create('testimonial_testimonial_type', function (Blueprint $table) {
            $table->unsignedBigInteger('testimonial_id');
            $table->foreign('testimonial_id', 'testimonial_id_fk_5106211')->references('id')->on('testimonials')->onDelete('cascade');
            $table->unsignedBigInteger('testimonial_type_id');
            $table->foreign('testimonial_type_id', 'testimonial_type_id_fk_5106211')->references('id')->on('testimonial_types')->onDelete('cascade');
        });
    }
}
