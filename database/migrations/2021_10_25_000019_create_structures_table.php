<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStructuresTable extends Migration
{
    public function up()
    {
        Schema::create('structures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label');
            $table->string('type');
            $table->string('link')->nullable();
            $table->boolean('external')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->nestedSet();
        });
    }
}
