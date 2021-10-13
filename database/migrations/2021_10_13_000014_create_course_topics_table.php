<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTopicsTable extends Migration
{
    public function up()
    {
        Schema::create('course_topics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('body')->nullable();
            $table->integer('field_offsiteid')->unique();
            $table->longText('field_speakers')->nullable();
            $table->string('field_ad_code')->nullable();
            $table->string('field_supplier_code')->nullable();
            $table->boolean('field_on_sale')->default(0)->nullable();
            $table->string('field_position')->nullable();
            $table->string('field_volume')->nullable();
            $table->string('field_issue')->nullable();
            $table->integer('field_media_provider_topic')->nullable();
            $table->date('field_aana_expiration_date')->nullable();
            $table->date('field_expiration_date')->nullable();
            $table->decimal('field_price', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
