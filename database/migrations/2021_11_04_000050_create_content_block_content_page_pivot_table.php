<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentBlockContentPagePivotTable extends Migration
{
    public function up()
    {
        Schema::create('content_block_content_page', function (Blueprint $table) {
            $table->unsignedBigInteger('content_block_id');
            $table->foreign('content_block_id', 'content_block_id_fk_5186545')->references('id')->on('content_blocks')->onDelete('cascade');
            $table->unsignedBigInteger('content_page_id');
            $table->foreign('content_page_id', 'content_page_id_fk_5186545')->references('id')->on('content_pages')->onDelete('cascade');
        });
    }
}
