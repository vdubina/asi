<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCourseCouponsTable extends Migration
{
    public function up()
    {
        Schema::table('course_coupons', function (Blueprint $table) {
            $table->unsignedBigInteger('media_type_id')->nullable();
            $table->foreign('media_type_id', 'media_type_fk_5262889')->references('id')->on('taxonomy_media_types');
        });
    }
}
