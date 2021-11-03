<?php

namespace EolabsIo\PriceFeeds\Tests\Unit\Bitrue;

use EolabsIo\PriceFeeds\Tests\Unit\BaseModelTest;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Models\TickerSummary;

class TickerSummaryTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return TickerSummary::class;
    }
}
