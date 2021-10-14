<?php

namespace EolabsIo\PriceFeeds\Domain\Binance\Shared;

use EolabsIo\PriceFeeds\Domain\Shared\BaseWebSocketClient;

abstract class BinanceWebSocket extends BaseWebSocketClient
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
        $streamsQueryString = $this->getStreamsQueryString();

        return "wss://stream.binance.com:9443".$streamsQueryString;
    }

    public function getStreamsQueryString() :string
    {
        $currencyPairsList = $this->listOfCurrencyPairs($this->getCurrencyPairs());

        return '/stream?streams='.$currencyPairsList;
    }

    private function listOfCurrencyPairs(array $currencyPairs): string
    {
        return array_reduce($currencyPairs, function ($carry, $item) {
            return (is_null($carry))? $item: $carry . "/". $item;
        });
    }

    public function getSubscribeMessage(): array
    {
        return [
            "method" => "SUBSCRIBE",
            "params" => $this->getTradeParams(),
            "id" => $this->id,
        ];
    }

    public function getUnsubscribeMessage(): array
    {
        return [
            "method" => "UNSUBSCRIBE",
            "params" => $this->getTradeParams(),
            "id" => $this->id,
        ];
    }

    public function getTradeParams(): array
    {
        return array_map(
            function ($currencyPair) {
                return $currencyPair."@trade";
            },
            $this->getCurrencyPairs()
        );
    }

    abstract protected function getChannel(): string;

    public function getCurrencyPairs(): array
    {
        return $this->currencyPairs;
    }

    public function processMesssage($message)
    {
        $result = data_get($message, 'result', '__no_result__'); //Binace returns "null" on success.
        $id = data_get($message, 'id');

        $success = (is_null($result) && $id == $this->id);

        if ($success) {
            $this->isSubscribed = true;
        }

        $this->onMessage($message);
    }

    abstract public function onMessage($message);
}
