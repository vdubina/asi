<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxonomyCourseTypesTable extends Migration
{
    public function up()
    {
        Schema::create('taxonomy_course_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->integer('field_offsiteid')->unique();
            $table->boolean('field_adsubscribable')->default(0)->nullable();
            $table->boolean('field_custom_course_layout')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
