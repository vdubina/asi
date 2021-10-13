<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxonomyDiscountTypesTable extends Migration
{
    public function up()
    {
        Schema::create('taxonomy_discount_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->integer('field_offsiteid')->unique();
            $table->integer('field_amount');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
