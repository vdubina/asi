<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTaxonomyCoursesTable extends Migration
{
    public function up()
    {
        Schema::table('taxonomy_courses', function (Blueprint $table) {
            $table->unsignedBigInteger('field_course_type_id')->nullable();
            $table->foreign('field_course_type_id', 'field_course_type_fk_5103953')->references('id')->on('taxonomy_course_types');
        });
    }
}
