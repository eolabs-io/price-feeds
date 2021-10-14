<?php
namespace EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\LiveTickerWebSocket;

class LtcUsdtLiveTickerCommand extends Command
{
    protected $signature = 'bitrue:ltcusdt-live-ticker';

    protected $description = 'Subscribes to the Bitrue LTC/USDT price feed.';


    public function handle()
    {
        $currencyPair = 'ltcusdt';

        $this->info("Connecting to Bitrue Live Ticker for {$currencyPair}...");

        $client = new LiveTickerWebSocket($currencyPair);

        $client->start();
    }
}
