<?php
namespace EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\LiveTickerWebSocket;

class LtcUsdLiveTickerCommand extends Command
{
    protected $signature = 'bitstamp:ltcusd-live-ticker';

    protected $description = 'Subscribes to the bitstamp LTC/USD price feed.';


    public function handle()
    {
        $currencyPair = 'ltcusd';

        $this->info("Connecting to Bitstamp Live Ticker for {$currencyPair}...");

        $client = new LiveTickerWebSocket($currencyPair);

        $client->start();
    }
}
