<?php
namespace EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\LiveTickerWebSocket;

class XlmUsdLiveTickerCommand extends Command
{
    protected $signature = 'Bitfinex:xlmusd-live-ticker';

    protected $description = 'Subscribes to the Bitfinex XLM/USD price feed.';


    public function handle()
    {
        $currencyPair = 'xlmusd';

        $this->info("Connecting to Bitfinex Live Ticker for {$currencyPair}...");

        $client = new LiveTickerWebSocket($currencyPair);

        $client->start();
    }
}
