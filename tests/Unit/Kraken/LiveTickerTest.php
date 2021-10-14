<?php
namespace EolabsIo\PriceFeeds\Tests\Unit\Kraken;

use EolabsIo\PriceFeeds\Tests\Unit\BaseModelTest;
use EolabsIo\PriceFeeds\Domain\Kraken\LiveTicker\Models\LiveTicker;

class LiveTickerTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return LiveTicker::class;
    }
}
