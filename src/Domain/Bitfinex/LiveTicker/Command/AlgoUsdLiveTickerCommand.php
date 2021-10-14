<?php

namespace EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\LiveTickerWebSocket;

class AlgoUsdLiveTickerCommand extends Command
{
    protected $signature = 'bitfinex:algousd-live-ticker';

    protected $description = 'Subscribes to the Bitfinex ALGO/USD price feed.';


    public function handle()
    {
        $currencyPair = 'algousd';

        $this->info("Connecting to Bitfinex Live Ticker for {$currencyPair}...");

        $client = new LiveTickerWebSocket($currencyPair);

        $client->start();
    }
}
