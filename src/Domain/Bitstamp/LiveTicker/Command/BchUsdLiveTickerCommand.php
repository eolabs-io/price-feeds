<?php
namespace EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\LiveTickerWebSocket;

class BchUsdLiveTickerCommand extends Command
{
    protected $signature = 'bitstamp:bchusd-live-ticker';

    protected $description = 'Subscribes to the bitstamp BCH/USD price feed.';


    public function handle()
    {
        $currencyPair = 'bchusd';

        $this->info("Connecting to Bitstamp Live Ticker for {$currencyPair}...");

        $client = new LiveTickerWebSocket($currencyPair);

        $client->start();
    }
}
