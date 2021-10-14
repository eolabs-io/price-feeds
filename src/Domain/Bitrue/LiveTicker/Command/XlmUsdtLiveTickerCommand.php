<?php
namespace EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\LiveTickerWebSocket;

class XlmUsdtLiveTickerCommand extends Command
{
    protected $signature = 'bitrue:xlmusdt-live-ticker';

    protected $description = 'Subscribes to the Bitrue XLM/USDT price feed.';


    public function handle()
    {
        $currencyPair = 'xlmusdt';

        $this->info("Connecting to Bitrue Live Ticker for {$currencyPair}...");

        $client = new LiveTickerWebSocket($currencyPair);

        $client->start();
    }
}
