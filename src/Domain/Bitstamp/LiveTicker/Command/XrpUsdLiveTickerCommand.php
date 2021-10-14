<?php
namespace EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\LiveTickerWebSocket;

class XrpUsdLiveTickerCommand extends Command
{
    protected $signature = 'bitstamp:xrpusd-live-ticker';

    protected $description = 'Subscribes to the bitstamp XRP/USD price feed.';


    public function handle()
    {
        $currencyPair = 'xrpusd';

        $this->info("Connecting to Bitstamp Live Ticker for {$currencyPair}...");

        $client = new LiveTickerWebSocket($currencyPair);

        $client->start();
    }
}
