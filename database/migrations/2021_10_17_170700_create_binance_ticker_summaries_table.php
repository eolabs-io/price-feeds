<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBinanceTickerSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binance_ticker_summaries', function (Blueprint $table) {
            $table->id();
            $table->string('currency_pair');
            $table->float('min_price', 15, 10);
            $table->float('max_price', 15, 10);
            $table->float('avg_price', 15, 10);
            $table->integer('aggregating_timestamp');
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
        Schema::dropIfExists('binance_ticker_summaries');
    }
}
