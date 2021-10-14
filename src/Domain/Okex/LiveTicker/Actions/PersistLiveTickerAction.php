<?php

namespace EolabsIo\PriceFeeds\Domain\Okex\LiveTicker\Actions;

use EolabsIo\PriceFeeds\Domain\Shared\Actions\PersistAction;
use EolabsIo\PriceFeeds\Domain\Okex\LiveTicker\Models\LiveTicker;

class PersistLiveTickerAction implements PersistAction
{
    private array $message;

    public function __construct(array $message)
    {
        $this->message = $message;
    }

    public function execute()
    {
        foreach ($this->message as $payload) {
            $attributes = $this->mapMessageAttributes($payload);
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
            'instType' => 'inst_type',
            'instId' => 'inst_id',
            'last' => 'last',
            'lastSz' => 'last_sz',
            'askPx' => 'ask_px',
            'askSz' => 'ask_sz',
            'bidPx' => 'bid_px',
            'bidSz' => 'bid_sz',
            'open24h' => 'open_24h',
            'high24h' => 'high_24h',
            'low24h' => 'low_24h',
            'sodUtc0' => 'sod_utc_0',
            'sodUtc8' => 'sod_utc_8',
            'volCcy24h' => 'vol_ccy_24h',
            'vol24h' => 'vol_24h',
            'ts' => 'ts',
        ];
    }
}
