<?php

namespace EolabsIo\PriceFeeds\Domain\Okex\Shared;

use EolabsIo\PriceFeeds\Domain\Shared\BaseWebSocketClient;

abstract class OkexWebSocket extends BaseWebSocketClient
{
    private array $currencyPairs;

    public function __construct(array $currencyPairs, $client = null)
    {
        parent::__construct($client);

        $this->currencyPairs = $currencyPairs;
    }

    public function getWebSocketUrl(): string
    {
        return "wss://ws.okex.com:8443/ws/v5/public";
    }

    public function getSubscribeMessage(): array
    {
        return [
            'op' => 'subscribe',
            'args' => $this->getArgs(),
        ];
    }

    public function getUnsubscribeMessage(): array
    {
        return [
            'op' => 'unsubscribe',
            'args' => $this->getArgs(),
        ];
    }

    public function getArgs(): array
    {
        return array_map(function ($currencyPair) {
            return [
                "channel" => "tickers",
                "instId" => $currencyPair,
            ];
        }, $this->getCurrencyPairs());
    }

    public function getCurrencyPairs(): array
    {
        return $this->currencyPairs;
    }

    public function processMesssage($message)
    {
        $event = data_get($message, 'event');

        switch ($event) {
            case 'subscribed':
                $this->isSubscribed = true;
                break;
            case 'unsubscribe':
                $this->isSubscribed = false;
                break;
        }

        $this->onMessage($message);
    }

    abstract public function onMessage($message);
}
