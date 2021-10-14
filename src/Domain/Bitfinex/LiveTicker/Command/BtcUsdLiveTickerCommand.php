<?php

namespace EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\LiveTickerWebSocket;

class BtcUsdLiveTickerCommand extends Command
{
    protected $signature = 'bitfinex:btcusd-live-ticker';

    protected $description = 'Subscribes to the Bitfinex BTC/USD price feed.';


    public function handle()
    {
        $currencyPair = 'btcusd';

        $this->info("Connecting to Bitfinex Live Ticker for {$currencyPair}...");

        $client = new LiveTickerWebSocket($currencyPair);

        $client->start();
    }
}
