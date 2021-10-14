<?php
namespace EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\LiveTickerWebSocket;

class XrpUsdLiveTickerCommand extends Command
{
    protected $signature = 'bitfinex:xrpusd-live-ticker';

    protected $description = 'Subscribes to the Bitfinex XRP/USD price feed.';


    public function handle()
    {
        $currencyPair = 'xrpusd';

        $this->info("Connecting to Bitfinex Live Ticker for {$currencyPair}...");

        $client = new LiveTickerWebSocket($currencyPair);

        $client->start();
    }
}
