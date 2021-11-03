<?php

namespace EolabsIo\PriceFeeds\Tests\Feature\Coinbase;

use EolabsIo\PriceFeeds\Tests\TestCase;
use EolabsIo\PriceFeeds\Domain\Coinbase\LiveTicker\Models\LiveTicker;
use EolabsIo\PriceFeeds\Domain\Coinbase\LiveTicker\Jobs\ProcessLiveTickerResponse;

class ProcessLiveTickerResponseTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $response = $this->getLiveTickerResponse();
        (new ProcessLiveTickerResponse($response))->handle();
    }

    /** @test */
    public function it_can_process_live_ticker_response()
    {
        $liveTicker = LiveTicker::first();
        $expected = $this->getLiveTickerResponse();

        $this->assertEquals(data_get($expected, 'type'), $liveTicker->type);
        $this->assertEquals(data_get($expected, 'sequence'), $liveTicker->sequence);
        $this->assertEquals(data_get($expected, 'product_id'), $liveTicker->product_id);
        $this->assertEquals(data_get($expected, 'price'), $liveTicker->price);
        $this->assertEquals(data_get($expected, 'open_24h'), $liveTicker->open_24h);
        $this->assertEquals(data_get($expected, 'volume_24h'), $liveTicker->volume_24h);
        $this->assertEquals(data_get($expected, 'low_24h'), $liveTicker->low_24h);
        $this->assertEquals(data_get($expected, 'high_24h'), $liveTicker->high_24h);
        $this->assertEquals(data_get($expected, 'volume_30d'), $liveTicker->volume_30d);
        $this->assertEquals(data_get($expected, 'best_bid'), $liveTicker->best_bid);
        $this->assertEquals(data_get($expected, 'best_ask'), $liveTicker->best_ask);
        $this->assertEquals(data_get($expected, 'side'), $liveTicker->side);
        $this->assertEquals(data_get($expected, 'time'), $liveTicker->time);
        $this->assertEquals(data_get($expected, 'trade_id'), $liveTicker->trade_id);
        $this->assertEquals(data_get($expected, 'last_size'), $liveTicker->last_size);
    }


    public function getLiveTickerResponse(): array
    {
        return [
            "type" => "ticker",
            "sequence" => 2189278583,
            "product_id" => "ADA-USD",
            "price" => "2.381",
            "open_24h" => "2.3812",
            "volume_24h" => "59152307.64000000",
            "low_24h" => "2.3118",
            "high_24h" => "2.4395",
            "volume_30d" => "4091635515.89000000",
            "best_bid" => "2.3810",
            "best_ask" => "2.3812",
            "side" => "sell",
            "time" => "2021-09-18T16:51:17.466959Z",
            "trade_id" => 34090201,
            "last_size" => "1380",
        ];
    }
}
