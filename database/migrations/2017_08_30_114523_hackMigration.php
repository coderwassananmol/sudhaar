<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HackMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentCase', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category');
            $table->string('subcat')->nullable();
            $table->string('place');
            $table->string('officer')->nullable();
            $table->string('service');
            $table->text('case');
            $table->boolean('proof')->nullable()->default(0);
            $table->boolean('anonymous')->nullable()->default(0);
            $table->integer('userid')->unsigned();
            $table->foreign('userid')->references('id')->on('users');
            $table->string('file')->nullable();
            $table->integer('total_rating')->nullable()->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hackMigration');
    }
}
