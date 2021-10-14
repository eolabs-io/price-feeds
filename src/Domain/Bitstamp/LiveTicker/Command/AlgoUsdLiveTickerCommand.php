<?php
namespace EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\LiveTickerWebSocket;

class AlgoUsdLiveTickerCommand extends Command
{
    protected $signature = 'bitstamp:algousd-live-ticker';

    protected $description = 'Subscribes to the bitstamp ALGO/USD price feed.';


    public function handle()
    {
        $currencyPair = 'algousd';

        $this->info("Connecting to Bitstamp Live Ticker for {$currencyPair}...");

        $client = new LiveTickerWebSocket($currencyPair);

        $client->start();
    }
}
