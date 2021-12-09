<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxonomyCouponCodesTable extends Migration
{
    public function up()
    {
        Schema::create('taxonomy_coupon_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->integer('field_offsiteid')->unique();
            $table->integer('field_value');
            $table->integer('field_type');
            $table->integer('field_max_uses');
            $table->boolean('field_inactive')->default(0)->nullable();
            $table->string('field_exclusive')->nullable();
            $table->date('field_date_start')->nullable();
            $table->date('field_date_end')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
