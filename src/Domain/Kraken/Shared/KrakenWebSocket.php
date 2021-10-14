<?php

namespace EolabsIo\PriceFeeds\Domain\Kraken\Shared;

use EolabsIo\PriceFeeds\Domain\Shared\BaseWebSocketClient;

abstract class KrakenWebSocket extends BaseWebSocketClient
{
    private array $currencyPairs;
    private int $id;

    public function __construct(array $currencyPairs, $client = null)
    {
        $this->currencyPairs = $currencyPairs;
        $this->id = rand();
        parent::__construct($client);
    }

    public function getWebSocketUrl(): string
    {
        return "wss://ws.kraken.com";
    }

    public function getSubscribeMessage(): array
    {
        return [
            "event" => "subscribe",
            "reqid" => $this->id,
            "pair" => $this->getCurrencyPairs(),
            "subscription" => [
              "name" => "trade"
            ],
        ];
    }

    public function getUnsubscribeMessage(): array
    {
        return [
            "event" => "unsubscribe",
            "reqid" => $this->id,
            "pair" => $this->getCurrencyPairs(),
            "subscription" => [
              "name" => "trade"
            ],
        ];
    }

    public function getCurrencyPairs(): array
    {
        return $this->currencyPairs;
    }

    public function processMesssage($message)
    {
        $event = data_get($message, 'event');
        $status = data_get($message, 'status');

        if ($event == 'subscriptionStatus') {
            switch ($status) {
                case 'subscribed':
                    $this->isSubscribed = true;
                    break;
                case 'unsubscribe':
                    $this->isSubscribed = false;
                    break;
            }
        }

        $this->onMessage($message);
    }

    abstract public function onMessage($message);
}
