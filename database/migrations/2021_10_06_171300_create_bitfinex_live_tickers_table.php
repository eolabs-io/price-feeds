<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBitfinexLiveTickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitfinex_live_tickers', function (Blueprint $table) {
            $table->id();
            $table->float('bid', 15, 8);
            $table->float('bid_size', 15, 8);
            $table->float('ask', 15, 8);
            $table->float('ask_size', 15, 8);
            $table->float('daily_change', 15, 8);
            $table->float('daily_change_relative', 15, 8);
            $table->float('last_price', 15, 8);
            $table->float('volume', 20, 8);
            $table->float('high', 15, 8);
            $table->float('low', 15, 8);
            $table->string('currency_pair');
            $table->bigInteger('timestamp');
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
        Schema::dropIfExists('bitfinex_live_tickers');
    }
}
