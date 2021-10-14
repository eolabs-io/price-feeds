<?php

namespace EolabsIo\PriceFeeds\Domain\Kraken\LiveTicker;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use EolabsIo\PriceFeeds\Domain\Kraken\Shared\KrakenWebSocket;
use EolabsIo\PriceFeeds\Domain\Kraken\LiveTicker\Jobs\ProcessLiveTickerResponse;

class LiveTickerWebSocket extends KrakenWebSocket
{
    public $shouldPersist = true;
    public $shouldCache = true;

    public function __construct(array $currencyPairs, $client = null)
    {
        parent::__construct($currencyPairs, $client);
    }

    public function onMessage($message)
    {
        $event = data_get($message, 'event');

        if (is_null($event)) {
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
        $pair = $message[3];
        $currencyPair = (string) Str::of($pair)->remove('/')->lower();
        $key = "kraken_ticker_" . $currencyPair;

        Cache::put($key, $message);
    }
}
