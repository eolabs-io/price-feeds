<?php

namespace EolabsIo\PriceFeeds\Domain\Binance\LiveTicker;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use EolabsIo\PriceFeeds\Domain\Binance\Shared\BinanceWebSocket;
use EolabsIo\PriceFeeds\Domain\Binance\LiveTicker\Jobs\ProcessLiveTickerResponse;

class LiveTickerWebSocket extends BinanceWebSocket
{
    public $shouldPersist = true;
    public $shouldCache = true;

    public function __construct(array $currencyPairs, $client = null)
    {
        parent::__construct($currencyPairs, $client);
    }

    protected function getChannel(): string
    {
        return '';
    }

    public function onMessage($message)
    {
        $event = data_get($message, 'data.e');

        if ($event == 'trade') {
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
        $symbol= data_get($message, 'data.s');
        $currencyPair = (string) Str::of($symbol)->lower();
        $key = "binance_ticker_" . $currencyPair;

        Cache::put($key, $message);
    }
}
