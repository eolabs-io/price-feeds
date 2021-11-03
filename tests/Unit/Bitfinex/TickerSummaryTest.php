<?php

namespace EolabsIo\PriceFeeds\Tests\Unit\Bitfinex;

use EolabsIo\PriceFeeds\Tests\Unit\BaseModelTest;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Models\TickerSummary;

class TickerSummaryTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return TickerSummary::class;
    }
}
