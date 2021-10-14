<?php

namespace EolabsIo\PriceFeeds\Domain\Bitrue\Shared;

use Illuminate\Support\Str;
use EolabsIo\PriceFeeds\Domain\Shared\BaseWebSocketClient;

abstract class BitrueWebSocket extends BaseWebSocketClient
{
    private string $currencyPair;

    public function __construct(string $currencyPair, $client = null)
    {
        $this->currencyPair = $currencyPair;
        parent::__construct($client);

        $this->gzDecodeResponse();
    }

    public function getWebSocketUrl(): string
    {
        return "wss://ws.bitrue.com/kline-api/ws";
    }

    public function getSubscribeMessage(): array
    {
        return [
            "event" => "sub",
            "params" => $this->getTradeParams(),
        ];
    }

    public function getUnsubscribeMessage(): array
    {
        return [
            "method" => "unsub",
            "params" => $this->getTradeParams(),
        ];
    }

    public function getTradeParams(): array
    {
        return [
            "cb_id" => $this->getCbId(),
            "channel" => $this->getChannel(),
        ];
    }

    protected function getCbId(): string
    {
        return Str::lower($this->currencyPair);
    }

    abstract protected function getChannel(): string;

    public function getCurrencyPair(): string
    {
        return $this->currencyPair;
    }

    public function processMesssage($message)
    {
        $event = data_get($message, 'event_rep');

        switch ($event) {
            case 'subed':
                $this->isSubscribed = true;
                break;
            case 'unsubed':
                $this->isSubscribed = false;
                break;
        }

        $this->onMessage($message);
    }

    abstract public function onMessage($message);
}
