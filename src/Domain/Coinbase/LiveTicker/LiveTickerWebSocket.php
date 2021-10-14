<?php

namespace EolabsIo\PriceFeeds\Domain\Coinbase\LiveTicker;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use EolabsIo\PriceFeeds\Domain\Coinbase\Shared\CoinbaseWebSocket;
use EolabsIo\PriceFeeds\Domain\Coinbase\LiveTicker\Jobs\ProcessLiveTickerResponse;

class LiveTickerWebSocket extends CoinbaseWebSocket
{
    public $shouldPersist = true;
    public $shouldCache = true;

    public function __construct(array $productIds, $client = null)
    {
        parent::__construct($productIds, $client);
    }

    protected function getChannels(): array
    {
        return [
            [
                'name' => 'ticker',
                'product_ids' => $this->getProductIds()
            ]
        ];
    }

    public function onMessage($message)
    {
        $type = $message['type'];

        if ($type == 'ticker') {
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
        $productId = data_get($message, 'product_id');
        $currencyPair = (string) Str::of($productId)->remove('-')->lower();
        $key = "coinbase_ticker_" . $currencyPair;

        Cache::put($key, $message);
    }
}
