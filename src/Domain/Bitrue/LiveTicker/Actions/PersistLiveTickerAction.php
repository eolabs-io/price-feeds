<?php

namespace EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Actions;

use Illuminate\Support\Str;
use EolabsIo\PriceFeeds\Domain\Shared\Actions\PersistAction;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Models\LiveTicker;

class PersistLiveTickerAction implements PersistAction
{
    private array $message;

    public function __construct(array $message)
    {
        $this->message = $message;
    }

    public function execute()
    {
        $channel = $this->getChannel();
        $tickers = data_get($this->message, 'tick.data');

        foreach ($tickers as $ticker) {
            $attributes = $ticker;
            $attributes['channel'] = $channel;

            LiveTicker::create($attributes);
        }
    }

    public function getChannel(): string
    {
        return Str::of(data_get($this->message, 'channel'))
            ->after('market_')
            ->before('_trade_ticker');
    }
}
