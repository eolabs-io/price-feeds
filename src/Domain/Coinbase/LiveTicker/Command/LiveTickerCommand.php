<?php

namespace EolabsIo\PriceFeeds\Domain\Coinbase\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Coinbase\LiveTicker\LiveTickerWebSocket;

class LiveTickerCommand extends Command
{
    protected $signature = 'coinbase:live-ticker
                            {currency-pairs* : The currency pair to subscribe to i.e. XRP-USD, LTC-USD, etc}';

    protected $description = 'Subscribes to the coinsbase price feed.';


    public function handle()
    {
        $currencyPairs = $this->argument('currency-pairs');

        $currencyPairList = $this->listOfCurrencyPairs($currencyPairs);

        $this->info("Connecting to Coinbase Live Ticker for {$currencyPairList}...");

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
