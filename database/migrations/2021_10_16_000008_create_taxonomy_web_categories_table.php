<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxonomyWebCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('taxonomy_web_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->integer('field_offsiteid')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
