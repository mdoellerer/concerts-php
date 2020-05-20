<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateConcertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('concerts', function (Blueprint $table) {
            //
            $table->integer('concert_type_id')->unsigned();
            $table->foreign('concert_type_id')->references('id')->on('concert_types');
            
            $table->biginteger('artist_id')->unsigned();
            $table->foreign('artist_id')->references('id')->on('artists');
            
            $table->biginteger('venue_id')->unsigned();
            $table->foreign('venue_id')->references('id')->on('venues');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('concerts', function (Blueprint $table) {
            //
        });
    }
}
