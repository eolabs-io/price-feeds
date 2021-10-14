<?php

namespace EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\LiveTickerWebSocket;

class BchUsdLiveTickerCommand extends Command
{
    protected $signature = 'bitfinex:bchusd-live-ticker';

    protected $description = 'Subscribes to the Bitfinex BCH/USD price feed.';


    public function handle()
    {
        $currencyPair = 'bchusd';

        $this->info("Connecting to Bitfinex Live Ticker for {$currencyPair}...");

        $client = new LiveTickerWebSocket($currencyPair);

        $client->start();
    }
}
