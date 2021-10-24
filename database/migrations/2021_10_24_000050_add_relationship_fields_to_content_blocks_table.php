<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToContentBlocksTable extends Migration
{
    public function up()
    {
        Schema::table('content_blocks', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id', 'type_fk_5186565')->references('id')->on('taxonomy_content_block_types');
        });
    }
}
