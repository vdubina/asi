<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxonomyAdServicesTable extends Migration
{
    public function up()
    {
        Schema::create('taxonomy_ad_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->integer('field_offsiteid')->unique();
            $table->string('field_ad_service_code');
            $table->boolean('field_audio_digest_subscription')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
