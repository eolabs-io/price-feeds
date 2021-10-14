<?php

namespace EolabsIo\PriceFeeds\Domain\Coinbase\LiveTicker\Actions;

use EolabsIo\PriceFeeds\Domain\Shared\Actions\PersistAction;
use EolabsIo\PriceFeeds\Domain\Coinbase\LiveTicker\Models\LiveTicker;

class PersistLiveTickerAction implements PersistAction
{
    private array $message;

    public function __construct(array $message)
    {
        $this->message = $message;
    }

    public function execute()
    {
        $attributes = $this->message;

        LiveTicker::create($attributes);
    }
}
