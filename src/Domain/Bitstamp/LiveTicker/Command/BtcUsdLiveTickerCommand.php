<?php
namespace EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\LiveTickerWebSocket;

class BtcUsdLiveTickerCommand extends Command
{
    protected $signature = 'bitstamp:btcusd-live-ticker';

    protected $description = 'Subscribes to the bitstamp BTC/USD price feed.';


    public function handle()
    {
        $currencyPair = 'btcusd';

        $this->info("Connecting to Bitstamp Live Ticker for {$currencyPair}...");

        $client = new LiveTickerWebSocket($currencyPair);

        $client->start();
    }
}
