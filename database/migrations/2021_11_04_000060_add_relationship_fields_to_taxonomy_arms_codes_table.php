<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTaxonomyArmsCodesTable extends Migration
{
    public function up()
    {
        Schema::table('taxonomy_arms_codes', function (Blueprint $table) {
            $table->unsignedBigInteger('field_arms_category_id');
            $table->foreign('field_arms_category_id', 'field_arms_category_fk_5104005')->references('id')->on('taxonomy_arms_categories');
        });
    }
}
