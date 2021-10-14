<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBitrueLiveTickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitrue_live_tickers', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->float('price', 15, 10);
            $table->float('amount', 15, 8);
            $table->string('side');
            $table->float('vol', 15, 8);
            $table->string('ts');
            $table->string('ds');
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
        Schema::dropIfExists('bitrue_live_tickers');
    }
}
