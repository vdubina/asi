<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseCouponCourseProductPivotTable extends Migration
{
    public function up()
    {
        Schema::create('course_coupon_course_product', function (Blueprint $table) {
            $table->unsignedBigInteger('course_coupon_id');
            $table->foreign('course_coupon_id', 'course_coupon_id_fk_5262890')->references('id')->on('course_coupons')->onDelete('cascade');
            $table->unsignedBigInteger('course_product_id');
            $table->foreign('course_product_id', 'course_product_id_fk_5262890')->references('id')->on('course_products')->onDelete('cascade');
        });
    }
}
