<?php

namespace EolabsIo\PriceFeeds\Domain\Kucoin\Shared;

use Illuminate\Support\Facades\Http;
use EolabsIo\PriceFeeds\Domain\Shared\BaseWebSocketClient;
use EolabsIo\PriceFeeds\Domain\Kucoin\Shared\Concerns\FormattsCurrencyPair;

abstract class KucoinWebSocket extends BaseWebSocketClient
{
    use FormattsCurrencyPair;

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
        $token = $this->getPublicToken();
        $connectionId = $this->id;

        return "wss://ws-api.kucoin.com/endpoint?token={$token}&[connectId={$connectionId}]";
    }

    public function getPublicToken(): string
    {
        $response = Http::post('https://api.kucoin.com/api/v1/bullet-public');
        $token = data_get($response->json(), 'data.token');

        return $token;
    }

    public function getSubscribeMessage(): array
    {
        $currencyPairsList = $this->listOfCurrencyPairs($this->getCurrencyPairs());

        return [
            "id" => $this->id,
            "type" => "subscribe",
            "topic" => "/market/ticker:".$currencyPairsList,
            "response" => true,
        ];
    }

    public function getUnsubscribeMessage(): array
    {
        $currencyPairsList = $this->listOfCurrencyPairs($this->getCurrencyPairs());

        return [
            "id" => $this->id,
            "type" => "unsubscribe",
            "topic" => "/market/ticker:".$currencyPairsList,
            "response" => true,
        ];
    }

    public function getCurrencyPairs(): array
    {
        return $this->currencyPairs;
    }

    public function processMesssage($message)
    {
        $type = data_get($message, 'type');

        if ($type == 'ack') {
            $this->isSubscribed = !$this->isSubscribed;
        }

        $this->onMessage($message);
    }

    abstract public function onMessage($message);
}
