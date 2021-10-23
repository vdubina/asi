<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentPageTaxonomyTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('content_page_taxonomy_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('content_page_id');
            $table->foreign('content_page_id', 'content_page_id_fk_5108784')->references('id')->on('content_pages')->onDelete('cascade');
            $table->unsignedBigInteger('taxonomy_tag_id');
            $table->foreign('taxonomy_tag_id', 'taxonomy_tag_id_fk_5108784')->references('id')->on('taxonomy_tags')->onDelete('cascade');
        });
    }
}
