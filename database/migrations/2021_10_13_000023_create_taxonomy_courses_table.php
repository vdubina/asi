<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxonomyCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('taxonomy_courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->boolean('field_available')->default(0)->nullable();
            $table->boolean('field_placeholder')->default(0)->nullable();
            $table->string('field_dental_report_text')->nullable();
            $table->longText('field_additional_information')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
