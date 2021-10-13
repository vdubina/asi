<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxonomyMediaDeliveriesTable extends Migration
{
    public function up()
    {
        Schema::create('taxonomy_media_deliveries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->integer('field_offsiteid');
            $table->boolean('field_isshipped')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
