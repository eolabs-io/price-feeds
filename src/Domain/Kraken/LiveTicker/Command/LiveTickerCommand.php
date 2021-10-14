<?php

namespace EolabsIo\PriceFeeds\Domain\Kraken\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Kraken\LiveTicker\LiveTickerWebSocket;

class LiveTickerCommand extends Command
{
    protected $signature = 'kraken:live-ticker
                            {currency-pairs* : The currency pair to subscribe to i.e. XRP/USDT, LTC/USDT, etc}';

    protected $description = 'Subscribes to the Kraken price feed.';


    public function handle()
    {
        $currencyPairs = $this->argument('currency-pairs');

        $currencyPairList = $this->listOfCurrencyPairs($currencyPairs);

        $this->info("Connecting to Kraken Live Ticker for {$currencyPairList}...");

        $client = new LiveTickerWebSocket($currencyPairs);

        $client->start();
    }

    private function listOfCurrencyPairs(array $currencyPairs): string
    {
        return array_reduce($currencyPairs, function ($carry, $item) {
            return (is_null($carry))? $item: $carry . ", ". $item;
        });
    }
}
