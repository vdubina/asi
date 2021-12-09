<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxonomyTopicSelectionTypesTable extends Migration
{
    public function up()
    {
        Schema::create('taxonomy_topic_selection_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->integer('field_offsiteid')->unique();
            $table->integer('field_sort_order');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
