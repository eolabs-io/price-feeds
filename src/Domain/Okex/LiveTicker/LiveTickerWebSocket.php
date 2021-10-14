<?php

namespace EolabsIo\PriceFeeds\Domain\Okex\LiveTicker;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use EolabsIo\PriceFeeds\Domain\Okex\Shared\OkexWebSocket;
use EolabsIo\PriceFeeds\Domain\Okex\LiveTicker\Jobs\ProcessLiveTickerResponse;

class LiveTickerWebSocket extends OkexWebSocket
{
    public $shouldPersist = true;
    public $shouldCache = true;

    public function __construct(array $currencyPairs, $client = null)
    {
        parent::__construct($currencyPairs, $client);
    }

    public function onMessage($message)
    {
        $channel = data_get($message, 'arg.channel');
        $payload = data_get($message, 'data');

        if ($channel === 'tickers' && !is_null($payload)) {
            $this->persist($payload);
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
        $channel = data_get($message, 'arg.instId');
        $channel = Str::of($channel)->remove('-')->lower();
        $key = "okex_" . $channel;

        Cache::put($key, $message);
    }
}
