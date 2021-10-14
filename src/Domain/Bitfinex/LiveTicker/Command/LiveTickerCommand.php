<?php

namespace EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\LiveTickerWebSocket;

class LiveTickerCommand extends Command
{
    protected $signature = 'bitfinex:live-ticker
                            {currency-pair : The currency pair to subscribe to.}';

    protected $description = 'Subscribes to the bitfinex price feed.';


    public function handle()
    {
        $currencyPair = $this->argument('currency-pair');

        $this->info("Connecting to Bitfinex Live Ticker for {$currencyPair}...");

        $client = new LiveTickerWebSocket($currencyPair);

        $client->start();
    }
}
