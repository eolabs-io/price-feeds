<?php

namespace EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker;

use Illuminate\Support\Facades\Cache;
use EolabsIo\PriceFeeds\Domain\Bitstamp\Shared\BitstampWebSocket;
use EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Jobs\ProcessLiveTickerResponse;

class LiveTickerWebSocket extends BitstampWebSocket
{
    public $shouldPersist = true;
    public $shouldCache = true;

    public function __construct(string $currencyPair, $client = null)
    {
        parent::__construct($currencyPair, $client);
    }

    protected function getChannel(): string
    {
        return 'live_trades_'.$this->getCurrencyPair();
    }

    public function onMessage($message)
    {
        $event = $message['event'];

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
        $channel = $this->getChannel();
        $key = "bitstamp_" . $channel;

        Cache::put($key, $message);
    }
}
