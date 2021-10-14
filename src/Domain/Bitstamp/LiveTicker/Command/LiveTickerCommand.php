<?php
namespace EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\LiveTickerWebSocket;

class LiveTickerCommand extends Command
{
    protected $signature = 'bitstamp:live-ticker
                            {currency-pair : The currency pair to subscribe to.}';

    protected $description = 'Subscribes to the bitstamp price feed.';


    public function handle()
    {
        $currencyPair = $this->argument('currency-pair');

        $this->info("Connecting to Bitstamp Live Ticker for {$currencyPair}...");

        $client = new LiveTickerWebSocket($currencyPair);

        $client->start();
    }
}
