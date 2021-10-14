<?php

namespace EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Actions;

use EolabsIo\PriceFeeds\Domain\Shared\Actions\PersistAction;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Models\LiveTicker;

class PersistLiveTickerAction implements PersistAction
{
    private array $message;

    public function __construct(array $message)
    {
        $this->message = $message;
    }


    public function execute()
    {
        $attributes = $this->mapMessageAttributes($this->message);

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
            0 => 'bid',
            1 => 'bid_size',
            2 => 'ask',
            3 => 'ask_size',
            4 => 'daily_change',
            5 => 'daily_change_relative',
            6 => 'last_price',
            7 => 'volume',
            8 => 'high',
            9 => 'low',
            'currency_pair' => 'currency_pair',
            'timestamp' => 'timestamp',
        ];
    }
}
