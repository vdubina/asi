<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCourseProductsTable extends Migration
{
    public function up()
    {
        Schema::table('course_products', function (Blueprint $table) {
            $table->unsignedBigInteger('field_course_type_id');
            $table->foreign('field_course_type_id', 'field_course_type_fk_5108685')->references('id')->on('taxonomy_course_types');
            $table->unsignedBigInteger('field_course_credit_type_id');
            $table->foreign('field_course_credit_type_id', 'field_course_credit_type_fk_5108686')->references('id')->on('taxonomy_credit_types');
            $table->unsignedBigInteger('field_practice_type_id');
            $table->foreign('field_practice_type_id', 'field_practice_type_fk_5108687')->references('id')->on('taxonomy_practice_types');
            $table->unsignedBigInteger('field_media_provider_id');
            $table->foreign('field_media_provider_id', 'field_media_provider_fk_5108688')->references('id')->on('taxonomy_media_providers');
            $table->unsignedBigInteger('field_media_delivery_type_id');
            $table->foreign('field_media_delivery_type_id', 'field_media_delivery_type_fk_5108689')->references('id')->on('taxonomy_media_deliveries');
            $table->unsignedBigInteger('field_web_category_id');
            $table->foreign('field_web_category_id', 'field_web_category_fk_5108690')->references('id')->on('taxonomy_web_categories');
        });
    }
}
