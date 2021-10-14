<?php

namespace EolabsIo\PriceFeeds\Domain\Bitstamp\Shared;

use EolabsIo\PriceFeeds\Domain\Shared\BaseWebSocketClient;

abstract class BitstampWebSocket extends BaseWebSocketClient
{
    private string $currencyPair;

    public function __construct(string $currencyPair, $client = null)
    {
        parent::__construct($client);

        $this->currencyPair = $currencyPair;
    }

    public function getWebSocketUrl(): string
    {
        return "wss://ws.bitstamp.net";
    }

    public function getSubscribeMessage(): array
    {
        return [
            "event" => "bts:subscribe",
            "data" => [
                "channel" => $this->getChannel()
            ]
        ];
    }

    public function getUnsubscribeMessage(): array
    {
        return [
            "event" => "bts:unsubscribe",
            "data" => [
                "channel" => $this->getChannel()
            ]
        ];
    }

    abstract protected function getChannel(): string;

    public function getCurrencyPair(): string
    {
        return $this->currencyPair;
    }

    public function processMesssage($message)
    {
        $event = $message['event'];

        switch ($event) {
            case 'bts:subscription_succeeded':
                $this->isSubscribed = true;
                break;
            case 'bts:unsubscribe':
                $this->isSubscribed = false;
                break;
            case 'bts:request_reconnect':
                $this->isSubscribed = false;
                $this->start();
        }

        $this->onMessage($message);
    }

    abstract public function onMessage($message);
}
