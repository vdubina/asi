<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseCouponsTable extends Migration
{
    public function up()
    {
        Schema::create('course_coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->integer('uses')->nullable();
            $table->string('field_offsiteid');
            $table->string('type');
            $table->float('amount', 15, 2)->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->boolean('on_demand')->default(0)->nullable();
            $table->boolean('invert')->default(0)->nullable();
            $table->boolean('exclusive')->default(0)->nullable();
            $table->datetime('date_from')->nullable();
            $table->datetime('date_to')->nullable();
            $table->integer('prev_days_less')->nullable();
            $table->integer('prev_days_more')->nullable();
            $table->timestamps();
        });
    }
}
