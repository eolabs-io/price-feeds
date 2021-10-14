<?php

namespace EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use EolabsIo\PriceFeeds\Domain\Bitfinex\Shared\BitfinexWebSocket;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Jobs\ProcessLiveTickerResponse;

class LiveTickerWebSocket extends BitfinexWebSocket
{
    public $shouldPersist = true;
    public $shouldCache = true;

    public function __construct(string $currencyPair, $client = null)
    {
        parent::__construct($currencyPair, $client);
    }

    public function onMessage($message)
    {
        $event = data_get($message, 'event', 'trade');

        if ($event === 'trade') {
            $subscribedChannelId = $this->getChannelId();
            [$channelId, $payload]= $message;

            if ($channelId === $subscribedChannelId && is_array($payload)) {
                $payload['currency_pair'] = $this->getCurrencyPair();
                $payload['timestamp'] = now()->getTimestamp();
                $this->persist($payload);
            }
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
        $channel = Str::lower($this->getCurrencyPair());
        $key = "bitfinexp_" . $channel;

        Cache::put($key, $message);
    }
}
