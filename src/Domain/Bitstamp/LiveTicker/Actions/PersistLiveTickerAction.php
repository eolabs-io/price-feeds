<?php

namespace EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Actions;

use EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Models\LiveTicker;
use EolabsIo\PriceFeeds\Domain\Shared\Actions\PersistAction;

class PersistLiveTickerAction implements PersistAction
{
    private array $message;

    public function __construct(array $message)
    {
        $this->message = $message;
    }

    public function execute()
    {
        $attributes = $this->message['data'];
        $attributes['channel'] = $this->message['channel'];

        LiveTicker::create($attributes);
    }
}
