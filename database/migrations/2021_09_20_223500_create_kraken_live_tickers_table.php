<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKrakenLiveTickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kraken_live_tickers', function (Blueprint $table) {
            $table->id();
            $table->string('price');
            $table->string('volume');
            $table->string('time');
            $table->string('side');
            $table->string('order_type');
            $table->string('misc');
            $table->string('pair');
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
        Schema::dropIfExists('kraken_live_tickers');
    }
}
