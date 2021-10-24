<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxonomyContentBlockTypesTable extends Migration
{
    public function up()
    {
        Schema::create('taxonomy_content_block_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('fa_icon')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
