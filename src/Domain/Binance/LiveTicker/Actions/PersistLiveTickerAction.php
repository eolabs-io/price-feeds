<?php

namespace EolabsIo\PriceFeeds\Domain\Binance\LiveTicker\Actions;

use EolabsIo\PriceFeeds\Domain\Shared\Actions\PersistAction;
use EolabsIo\PriceFeeds\Domain\Binance\LiveTicker\Models\LiveTicker;

class PersistLiveTickerAction implements PersistAction
{
    private array $message;

    public function __construct(array $message)
    {
        $this->message = $message;
    }

    public function execute()
    {
        $attributes = $this->mapMessageAttributes($this->message['data']);

        LiveTicker::create($attributes);
    }

    public function mapMessageAttributes(array $message): array
    {
        $messageAttributeMap = $this->getMessageAttributeMap();
        $attributes = [];
        foreach ($messageAttributeMap as $key => $value) {
            $attributes[$value] = data_get($message, $key);
        }

        return $attributes;
    }

    public function getMessageAttributeMap(): array
    {
        return [
            "e" => 'event_type',
            "E" => 'event_time',
            "s" => 'symbol',
            "t" => 'trade_id',
            "p" => 'price',
            "q" => 'quantity',
            "b" => 'buyer_order_id',
            "a" => 'seller_order_id',
            "T" => 'trade_time',
            "m" => 'buyer_is_the_market_maker',
            "M" => 'ignore',
        ];
    }
}
