<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseProductCourseTopicPivotTable extends Migration
{
    public function up()
    {
        Schema::create('course_product_course_topic', function (Blueprint $table) {
            $table->unsignedBigInteger('course_product_id');
            $table->foreign('course_product_id', 'course_product_id_fk_5108691')->references('id')->on('course_products')->onDelete('cascade');
            $table->unsignedBigInteger('course_topic_id');
            $table->foreign('course_topic_id', 'course_topic_id_fk_5108691')->references('id')->on('course_topics')->onDelete('cascade');
        });
    }
}
