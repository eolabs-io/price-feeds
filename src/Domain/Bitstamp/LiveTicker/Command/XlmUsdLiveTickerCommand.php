<?php
namespace EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\LiveTickerWebSocket;

class XlmUsdLiveTickerCommand extends Command
{
    protected $signature = 'bitstamp:xlmusd-live-ticker';

    protected $description = 'Subscribes to the bitstamp XLM/USD price feed.';


    public function handle()
    {
        $currencyPair = 'xlmusd';

        $this->info("Connecting to Bitstamp Live Ticker for {$currencyPair}...");

        $client = new LiveTickerWebSocket($currencyPair);

        $client->start();
    }
}
