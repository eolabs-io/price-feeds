<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKucoinLiveTickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kucoin_live_tickers', function (Blueprint $table) {
            $table->id();
            $table->string('best_ask');
            $table->string('best_ask_size');
            $table->string('best_bid');
            $table->string('best_bid_size');
            $table->string('price');
            $table->string('sequence');
            $table->string('size');
            $table->bigInteger('time');
            $table->string('currency_pair');
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
        Schema::dropIfExists('kucoin_live_tickers');
    }
}
