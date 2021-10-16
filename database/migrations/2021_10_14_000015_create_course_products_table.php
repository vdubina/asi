<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseProductsTable extends Migration
{
    public function up()
    {
        Schema::create('course_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sku');
            $table->string('title')->nullable();
            $table->decimal('commerce_price', 15, 2)->nullable();
            $table->boolean('status')->default(0)->nullable();
            $table->longText('field_description')->nullable();
            $table->string('field_course_length');
            $table->integer('field_offsiteid')->unique();
            $table->string('field_supplier_code');
            $table->boolean('field_is_ondemand')->default(0)->nullable();
            $table->boolean('field_disk_availability')->default(0)->nullable();
            $table->string('field_dental_report_text')->nullable();
            $table->string('field_download_availability')->nullable();
            $table->integer('field_standard_credit_hours')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
