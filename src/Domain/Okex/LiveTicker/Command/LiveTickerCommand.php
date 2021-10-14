<?php

namespace EolabsIo\PriceFeeds\Domain\Okex\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Okex\LiveTicker\LiveTickerWebSocket;
use EolabsIo\PriceFeeds\Domain\Okex\Shared\Concerns\FormattsCurrencyPair;

class LiveTickerCommand extends Command
{
    use FormattsCurrencyPair;

    protected $signature = 'okex:live-ticker
                            {currency-pairs* : The currency pair to subscribe to i.e. XRP-USDT, LTC-USDT, etc}';

    protected $description = 'Subscribes to the Okex price feed.';


    public function handle()
    {
        $currencyPairs = $this->argument('currency-pairs');

        $currencyPairList = $this->listOfCurrencyPairs($currencyPairs);

        $this->info("Connecting to Okex Live Ticker for {$currencyPairList}...");

        $client = new LiveTickerWebSocket($currencyPairs);

        $client->start();
    }
}
