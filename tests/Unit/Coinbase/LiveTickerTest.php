<?php
namespace EolabsIo\PriceFeeds\Tests\Unit\Coinbase;

use EolabsIo\PriceFeeds\Tests\Unit\BaseModelTest;
use EolabsIo\PriceFeeds\Domain\Coinbase\LiveTicker\Models\LiveTicker;

class LiveTickerTest extends BaseModelTest
{
    protected function getModelClass()
    {
        return LiveTicker::class;
    }
}
