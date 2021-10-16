<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentPageTestimonialPivotTable extends Migration
{
    public function up()
    {
        Schema::create('content_page_testimonial', function (Blueprint $table) {
            $table->unsignedBigInteger('testimonial_id');
            $table->foreign('testimonial_id', 'testimonial_id_fk_5108751')->references('id')->on('testimonials')->onDelete('cascade');
            $table->unsignedBigInteger('content_page_id');
            $table->foreign('content_page_id', 'content_page_id_fk_5108751')->references('id')->on('content_pages')->onDelete('cascade');
        });
    }
}
