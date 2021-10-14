<?php

namespace EolabsIo\PriceFeeds\Domain\Binance\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Binance\LiveTicker\LiveTickerWebSocket;

class LiveTickerCommand extends Command
{
    protected $signature = 'binance:live-ticker
                            {currency-pairs* : The currency pair to subscribe to i.e. xrpusdt, ltcusdt, etc}';

    protected $description = 'Subscribes to the coinsbase price feed.';


    public function handle()
    {
        $currencyPairs = $this->argument('currency-pairs');

        $currencyPairList = $this->listOfCurrencyPairs($currencyPairs);

        $this->info("Connecting to Binance Live Ticker for {$currencyPairList}...");

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
