<?php
namespace EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\LiveTickerWebSocket;

class AlgoUsdtLiveTickerCommand extends Command
{
    protected $signature = 'bitrue:algousdt-live-ticker';

    protected $description = 'Subscribes to the Bitrue ALGO/USDT price feed.';


    public function handle()
    {
        $currencyPair = 'algousdt';

        $this->info("Connecting to Bitrue Live Ticker for {$currencyPair}...");

        $client = new LiveTickerWebSocket($currencyPair);

        $client->start();
    }
}
