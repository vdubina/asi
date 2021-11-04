<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseInstructorCourseProductPivotTable extends Migration
{
    public function up()
    {
        Schema::create('course_instructor_course_product', function (Blueprint $table) {
            $table->unsignedBigInteger('course_instructor_id');
            $table->foreign('course_instructor_id', 'course_instructor_id_fk_5108707')->references('id')->on('course_instructors')->onDelete('cascade');
            $table->unsignedBigInteger('course_product_id');
            $table->foreign('course_product_id', 'course_product_id_fk_5108707')->references('id')->on('course_products')->onDelete('cascade');
        });
    }
}
