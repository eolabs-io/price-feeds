<?php

namespace EolabsIo\PriceFeeds\Tests\Unit\Kraken;

use EolabsIo\PriceFeeds\Tests\Unit\BaseModelTest;
use EolabsIo\PriceFeeds\Domain\Kraken\LiveTicker\Models\TickerSummary;

class TickerSummaryTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return TickerSummary::class;
    }
}
