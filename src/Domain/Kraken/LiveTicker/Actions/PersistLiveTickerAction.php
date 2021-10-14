<?php

namespace EolabsIo\PriceFeeds\Domain\Kraken\LiveTicker\Actions;

use EolabsIo\PriceFeeds\Domain\Shared\Actions\PersistAction;
use EolabsIo\PriceFeeds\Domain\Kraken\LiveTicker\Models\LiveTicker;

class PersistLiveTickerAction implements PersistAction
{
    private array $message;

    public function __construct(array $message)
    {
        $this->message = $message;
    }

    public function execute()
    {
        $pair = $this->message[3];
        $trades = $this->message[1];

        foreach ($trades as $trade) {
            $attributes = $this->mapMessageAttributes($trade);
            $attributes['pair'] = $pair;

            LiveTicker::create($attributes);
        }
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
            0 => 'price',
            1 => 'volume',
            2 => 'time',
            3 => 'side',
            4 => 'order_type',
            5 => 'misc',
            // 6 => 'pair',
        ];
    }
}
