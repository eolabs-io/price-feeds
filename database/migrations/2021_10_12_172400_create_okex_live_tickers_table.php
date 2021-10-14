<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOkexLiveTickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('okex_live_tickers', function (Blueprint $table) {
            $table->id();
            $table->string('inst_type');
            $table->string('inst_id');
            $table->float('last', 15, 10);
            $table->float('last_sz', 15, 8);
            $table->float('ask_px', 15, 10);
            $table->float('ask_sz', 15, 8);
            $table->float('bid_px', 15, 10);
            $table->float('bid_sz', 15, 8);
            $table->float('open_24h', 15, 10);
            $table->float('high_24h', 15, 10);
            $table->float('low_24h', 15, 10);
            $table->float('sod_utc_0', 15, 10);
            $table->float('sod_utc_8', 15, 10);
            $table->float('vol_ccy_24h', 18, 8);
            $table->float('vol_24h', 18, 8);
            $table->string('ts');
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
        Schema::dropIfExists('okex_live_tickers');
    }
}
