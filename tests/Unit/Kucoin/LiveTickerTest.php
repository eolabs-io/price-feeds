<?php

namespace EolabsIo\PriceFeeds\Tests\Unit\Kucoin;

use EolabsIo\PriceFeeds\Tests\Unit\BaseModelTest;
use EolabsIo\PriceFeeds\Domain\Kucoin\LiveTicker\Models\LiveTicker;

class LiveTickerTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return LiveTicker::class;
    }
}
