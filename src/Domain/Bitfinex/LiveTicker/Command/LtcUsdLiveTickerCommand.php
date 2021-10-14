<?php

namespace EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\LiveTickerWebSocket;

class LtcUsdLiveTickerCommand extends Command
{
    protected $signature = 'bitfinex:ltcusd-live-ticker';

    protected $description = 'Subscribes to the Bitfinex LTC/USD price feed.';


    public function handle()
    {
        $currencyPair = 'ltcusd';

        $this->info("Connecting to Bitfinex Live Ticker for {$currencyPair}...");

        $client = new LiveTickerWebSocket($currencyPair);

        $client->start();
    }
}
