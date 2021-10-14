<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinbaseLiveTickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coinbase_live_tickers', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->bigInteger('sequence');
            $table->string('product_id');
            $table->string('price');
            $table->string('open_24h');
            $table->string('volume_24h');
            $table->string('low_24h');
            $table->string('high_24h');
            $table->string('volume_30d');
            $table->string('best_bid');
            $table->string('best_ask');
            $table->string('side');
            $table->string('time');
            $table->bigInteger('trade_id');
            $table->string('last_size');
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
        Schema::dropIfExists('coinbase_live_tickers');
    }
}
