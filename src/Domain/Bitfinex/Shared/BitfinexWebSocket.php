<?php

namespace EolabsIo\PriceFeeds\Domain\Bitfinex\Shared;

use EolabsIo\PriceFeeds\Domain\Shared\BaseWebSocketClient;

abstract class BitfinexWebSocket extends BaseWebSocketClient
{
    private string $currencyPair;
    private $channelId;

    public function __construct(string $currencyPair, $client = null)
    {
        parent::__construct($client);

        $this->currencyPair = $currencyPair;
    }

    public function getWebSocketUrl(): string
    {
        return "wss://api-pub.bitfinex.com/ws/2";
    }

    public function getSubscribeMessage(): array
    {
        return [
            'event' => 'subscribe',
            'channel' => 'ticker',
            'symbol' => $this->getSymbol(),
        ];
    }

    public function getUnsubscribeMessage(): array
    {
        return [
            "event" => "unsubscribe",
            'channel' => 'ticker',
            'symbol' => $this->getSymbol(),
        ];
    }

    public function getSymbol(): string
    {
        return 't'.$this->getCurrencyPair();
    }

    public function getCurrencyPair(): string
    {
        return $this->currencyPair;
    }

    public function setChannelId(int $id = null)
    {
        $this->channelId = $id;
    }

    public function getChannelId(): int
    {
        return $this->channelId;
    }

    public function processMesssage($message)
    {
        $event = data_get($message, 'event');

        switch ($event) {
            case 'subscribed':
                $this->isSubscribed = true;
                $this->setChannelId(data_get($message, 'chanId'));
                break;
            case 'unsubscribe':
                $this->isSubscribed = false;
                $this->setChannelId();
                break;
        }

        $this->onMessage($message);
    }

    abstract public function onMessage($message);
}
