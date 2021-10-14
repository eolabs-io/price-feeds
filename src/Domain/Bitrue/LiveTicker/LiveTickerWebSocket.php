<?php

namespace EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use EolabsIo\PriceFeeds\Domain\Bitrue\Shared\BitrueWebSocket;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Jobs\ProcessLiveTickerResponse;

class LiveTickerWebSocket extends BitrueWebSocket
{
    public $shouldPersist = true;
    public $shouldCache = true;

    public function __construct(string $currencyPair, $client = null)
    {
        parent::__construct($currencyPair, $client);
    }

    protected function getChannel(): string
    {
        $currencyPair = $this->getCbId();
        return "market_{$currencyPair}_trade_ticker";
    }

    public function onMessage($message)
    {
        $channel = data_get($message, 'channel', '');
        $data = data_get($message, 'tick.data');

        if (Str::endsWith($channel, '_trade_ticker') && is_array($data)) {
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
        $currencyPair = $this->getCbId();
        $key = "bitrue_" . $currencyPair;

        Cache::put($key, $message);
    }
}
