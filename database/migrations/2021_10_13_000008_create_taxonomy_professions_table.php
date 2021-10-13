<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxonomyProfessionsTable extends Migration
{
    public function up()
    {
        Schema::create('taxonomy_professions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->integer('field_offsiteid')->unique();
            $table->string('field_salutation')->nullable();
            $table->boolean('field_allied_professional')->default(0)->nullable();
            $table->string('field_ad_customer_category')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
