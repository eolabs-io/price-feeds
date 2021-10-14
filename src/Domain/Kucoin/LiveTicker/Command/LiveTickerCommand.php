<?php

namespace EolabsIo\PriceFeeds\Domain\Kucoin\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Kucoin\LiveTicker\LiveTickerWebSocket;
use EolabsIo\PriceFeeds\Domain\Kucoin\Shared\Concerns\FormattsCurrencyPair;

class LiveTickerCommand extends Command
{
    use FormattsCurrencyPair;

    protected $signature = 'kucoin:live-ticker
                            {currency-pairs* : The currency pair to subscribe to i.e. XRP-USDT, LTC-USDT, etc}';

    protected $description = 'Subscribes to the kucoin price feed.';


    public function handle()
    {
        $currencyPairs = $this->argument('currency-pairs');

        $currencyPairList = $this->listOfCurrencyPairs($currencyPairs);

        $this->info("Connecting to Kucoin Live Ticker for {$currencyPairList}...");

        $client = new LiveTickerWebSocket($currencyPairs);

        $client->start();
    }
}
