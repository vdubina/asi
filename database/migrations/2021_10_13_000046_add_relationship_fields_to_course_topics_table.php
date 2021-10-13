<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCourseTopicsTable extends Migration
{
    public function up()
    {
        Schema::table('course_topics', function (Blueprint $table) {
            $table->unsignedBigInteger('field_course_type_id');
            $table->foreign('field_course_type_id', 'field_course_type_fk_5108657')->references('id')->on('taxonomy_course_types');
            $table->unsignedBigInteger('field_course_credit_type_id')->nullable();
            $table->foreign('field_course_credit_type_id', 'field_course_credit_type_fk_5108658')->references('id')->on('taxonomy_credit_types');
            $table->unsignedBigInteger('field_practice_type_id')->nullable();
            $table->foreign('field_practice_type_id', 'field_practice_type_fk_5108659')->references('id')->on('taxonomy_practice_types');
            $table->unsignedBigInteger('field_armscode_id')->nullable();
            $table->foreign('field_armscode_id', 'field_armscode_fk_5108660')->references('id')->on('taxonomy_arms_codes');
            $table->unsignedBigInteger('field_web_category_id')->nullable();
            $table->foreign('field_web_category_id', 'field_web_category_fk_5108661')->references('id')->on('taxonomy_web_categories');
            $table->unsignedBigInteger('field_ad_service_id')->nullable();
            $table->foreign('field_ad_service_id', 'field_ad_service_fk_5108662')->references('id')->on('taxonomy_ad_services');
            $table->unsignedBigInteger('field_media_provider_id')->nullable();
            $table->foreign('field_media_provider_id', 'field_media_provider_fk_5108663')->references('id')->on('taxonomy_media_providers');
        });
    }
}
