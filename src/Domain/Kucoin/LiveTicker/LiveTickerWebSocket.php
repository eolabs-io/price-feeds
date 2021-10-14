<?php

namespace EolabsIo\PriceFeeds\Domain\Kucoin\LiveTicker;

use Illuminate\Support\Facades\Cache;
use EolabsIo\PriceFeeds\Domain\Kucoin\Shared\KucoinWebSocket;
use EolabsIo\PriceFeeds\Domain\Kucoin\Shared\Concerns\FormattsCurrencyPair;
use EolabsIo\PriceFeeds\Domain\Kucoin\LiveTicker\Jobs\ProcessLiveTickerResponse;

class LiveTickerWebSocket extends KucoinWebSocket
{
    use FormattsCurrencyPair;

    public $shouldPersist = true;
    public $shouldCache = true;

    public function __construct(array $currencyPairs, $client = null)
    {
        parent::__construct($currencyPairs, $client);
    }

    public function onMessage($message)
    {
        $subject = data_get($message, 'subject');

        if ($subject == 'trade.ticker') {
            $this->persist($message);
        }
    }

    public function persist($message)
    {
        if ($this->shouldPersist) {
            ProcessLiveTickerResponse::dispatch($message);
        }

        if ($this->shouldCache) {
            $this->cache($message);
        }
    }

    public function cache($message)
    {
        $currencyPair = $this->getCurrencyPairFromMessage($message);

        $key = "kucoin_ticker_" . $currencyPair;

        Cache::put($key, $message);
    }
}
