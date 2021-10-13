<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTaxonomyWebCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('taxonomy_web_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('field_practice_type_id')->nullable();
            $table->foreign('field_practice_type_id', 'field_practice_type_fk_5104215')->references('id')->on('taxonomy_practice_types');
        });
    }
}
