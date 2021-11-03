<?php

namespace EolabsIo\PriceFeeds\Domain\Kraken\LiveTicker\Actions;

use EolabsIo\PriceFeeds\Domain\Shared\Actions\PersistAction;
use EolabsIo\PriceFeeds\Domain\Shared\Concerns\HasSummaryParams;
use EolabsIo\PriceFeeds\Domain\Kraken\LiveTicker\Models\LiveTicker;
use EolabsIo\PriceFeeds\Domain\Kraken\LiveTicker\Models\TickerSummary;

class SummarizeLiveTickerAction implements PersistAction
{
    use HasSummaryParams;

    private array $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function execute()
    {
        $summaryParams = $this->getSummaryParams($this->params);

        LiveTicker::withLiveTickerSummary($summaryParams)->each(function ($attributes) {
            TickerSummary::create($attributes->toArray());
        });
    }
}
