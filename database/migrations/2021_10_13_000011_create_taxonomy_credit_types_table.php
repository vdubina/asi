<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxonomyCreditTypesTable extends Migration
{
    public function up()
    {
        Schema::create('taxonomy_credit_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->integer('field_offsiteid');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
