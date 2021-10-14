<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBitstampLiveTickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitstamp_live_tickers', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->float('amount', 15, 10);
            $table->string('amount_str');
            $table->float('price', 15, 8);
            $table->string('price_str');
            $table->integer('type');
            $table->string('timestamp');
            $table->string('microtimestamp');
            $table->bigInteger('buy_order_id');
            $table->bigInteger('sell_order_id');
            $table->string('channel');
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
        Schema::dropIfExists('bitstamp_live_tickers');
    }
}
