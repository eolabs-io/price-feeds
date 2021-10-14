<?php

namespace EolabsIo\PriceFeeds\Domain\Coinbase\Shared;

use EolabsIo\PriceFeeds\Domain\Shared\BaseWebSocketClient;

abstract class CoinbaseWebSocket extends BaseWebSocketClient
{
    private array $productIds;

    public function __construct(array $productIds, $client = null)
    {
        parent::__construct($client);

        $this->productIds = $productIds;
    }

    public function getWebSocketUrl(): string
    {
        return "wss://ws-feed.pro.coinbase.com";
    }

    public function getSubscribeMessage(): array
    {
        return [
            "type" => "subscribe",
            "product_ids" => $this->getProductIds(),
            "channels" =>  $this->getChannels(),
        ];
    }

    public function getUnsubscribeMessage(): array
    {
        return [
            "type" => "unsubscribe",
            "product_ids" => $this->getProductIds(),
            "channels" =>  $this->getChannels(),
        ];
    }

    abstract protected function getChannels(): array;

    public function getProductIds(): array
    {
        return $this->productIds;
    }

    public function processMesssage($message)
    {
        $type = $message['type'];

        switch ($type) {
            case 'subscriptions':
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
