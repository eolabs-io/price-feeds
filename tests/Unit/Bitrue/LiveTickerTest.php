<?php

namespace EolabsIo\PriceFeeds\Tests\Unit\Bitrue;

use EolabsIo\PriceFeeds\Tests\Unit\BaseModelTest;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Models\LiveTicker;

class LiveTickerTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return LiveTicker::class;
    }
}
