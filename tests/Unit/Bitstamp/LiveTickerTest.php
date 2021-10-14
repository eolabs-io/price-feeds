<?php

namespace EolabsIo\PriceFeeds\Tests\Unit\Bitstamp;

use EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Models\LiveTicker;
use EolabsIo\PriceFeeds\Tests\Unit\BaseModelTest;

class LiveTickerTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return LiveTicker::class;
    }
}
