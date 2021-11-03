<?php

namespace EolabsIo\PriceFeeds\Tests\Unit\Bitstamp;

use EolabsIo\PriceFeeds\Tests\Unit\BaseModelTest;
use EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Models\TickerSummary;

class TickerSummaryTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return TickerSummary::class;
    }
}
