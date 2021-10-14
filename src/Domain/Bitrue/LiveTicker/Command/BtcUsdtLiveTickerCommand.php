<?php
namespace EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\LiveTickerWebSocket;

class BtcUsdtLiveTickerCommand extends Command
{
    protected $signature = 'bitrue:btcusdt-live-ticker';

    protected $description = 'Subscribes to the Bitrue BTC/USD price feed.';


    public function handle()
    {
        $currencyPair = 'btcusdt';

        $this->info("Connecting to Bitrue Live Ticker for {$currencyPair}...");

        $client = new LiveTickerWebSocket($currencyPair);

        $client->start();
    }
}
