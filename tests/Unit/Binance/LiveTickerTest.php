<?php

namespace EolabsIo\PriceFeeds\Tests\Unit\Binance;

use EolabsIo\PriceFeeds\Tests\Unit\BaseModelTest;
use EolabsIo\PriceFeeds\Domain\Binance\LiveTicker\Models\LiveTicker;

class LiveTickerTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return LiveTicker::class;
    }
}
