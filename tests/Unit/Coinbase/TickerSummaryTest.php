<?php

namespace EolabsIo\PriceFeeds\Tests\Unit\Coinbase;

use EolabsIo\PriceFeeds\Tests\Unit\BaseModelTest;
use EolabsIo\PriceFeeds\Domain\Coinbase\LiveTicker\Models\TickerSummary;

class TickerSummaryTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return TickerSummary::class;
    }
}
