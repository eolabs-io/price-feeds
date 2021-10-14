<?php
namespace EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\LiveTickerWebSocket;

class BchUsdtLiveTickerCommand extends Command
{
    protected $signature = 'bitrue:bchusdt-live-ticker';

    protected $description = 'Subscribes to the Bitrue BCH/USDT price feed.';


    public function handle()
    {
        $currencyPair = 'bchusdt';

        $this->info("Connecting to Bitrue Live Ticker for {$currencyPair}...");

        $client = new LiveTickerWebSocket($currencyPair);

        $client->start();
    }
}
