<?php
namespace EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\LiveTickerWebSocket;

class XrpUsdtLiveTickerCommand extends Command
{
    protected $signature = 'bitrue:xrpusdt-live-ticker';

    protected $description = 'Subscribes to the Bitrue XRP/USDT price feed.';


    public function handle()
    {
        $currencyPair = 'xrpusdt';

        $this->info("Connecting to Bitrue Live Ticker for {$currencyPair}...");

        $client = new LiveTickerWebSocket($currencyPair);

        $client->start();
    }
}
