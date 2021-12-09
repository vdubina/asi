<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxonomyPaymentTypesTable extends Migration
{
    public function up()
    {
        Schema::create('taxonomy_payment_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->integer('field_offsiteid')->unique();
            $table->boolean('field_cc')->default(0)->nullable();
            $table->boolean('field_online_only')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
