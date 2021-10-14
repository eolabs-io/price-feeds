<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBinanceLiveTickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binance_live_tickers', function (Blueprint $table) {
            $table->id();
            $table->string('event_type');
            $table->bigInteger('event_time');
            $table->string('symbol');
            $table->bigInteger('trade_id');
            $table->string('price');
            $table->string('quantity');
            $table->bigInteger('buyer_order_id');
            $table->bigInteger('seller_order_id');
            $table->bigInteger('trade_time');
            $table->boolean('buyer_is_the_market_maker');
            $table->boolean('ignore');
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
        Schema::dropIfExists('binance_live_tickers');
    }
}
