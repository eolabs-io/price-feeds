<?php

namespace EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\LiveTickerWebSocket;

class LiveTickerCommand extends Command
{
    protected $signature = 'bitrue:live-ticker
                            {currency-pair : The currency pair to subscribe to.}';

    protected $description = 'Subscribes to the Bitrue price feed.';


    public function handle()
    {
        $currencyPair = $this->argument('currency-pair');

        $this->info("Connecting to Bitrue Live Ticker for {$currencyPair}...");

        $client = new LiveTickerWebSocket($currencyPair);

        $client->start();
    }
}
