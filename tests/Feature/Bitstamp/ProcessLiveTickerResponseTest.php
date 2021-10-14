<?php

namespace EolabsIo\PriceFeeds\Tests\Feature\Bitstamp;

use EolabsIo\PriceFeeds\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Models\LiveTicker;
use EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Jobs\ProcessLiveTickerResponse;

class ProcessLiveTickerResponseTest extends TestCase
{
    use RefreshDatabase;

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

        $this->assertEquals(data_get($expected, 'data.id'), $liveTicker->id);
        $this->assertEquals(data_get($expected, 'data.timestamp'), $liveTicker->timestamp);
        $this->assertEquals(data_get($expected, 'data.amount'), $liveTicker->amount);
        $this->assertEquals(data_get($expected, 'data.amount_str'), $liveTicker->amount_str);
        $this->assertEquals(data_get($expected, 'data.price'), $liveTicker->price);
        $this->assertEquals(data_get($expected, 'data.price_str'), $liveTicker->price_str);
        $this->assertEquals(data_get($expected, 'data.type'), $liveTicker->type);
        $this->assertEquals(data_get($expected, 'data.microtimestamp'), $liveTicker->microtimestamp);
        $this->assertEquals(data_get($expected, 'data.buy_order_id'), $liveTicker->buy_order_id);
        $this->assertEquals(data_get($expected, 'data.sell_order_id'), $liveTicker->sell_order_id);
        $this->assertEquals(data_get($expected, 'channel'), $liveTicker->channel);
    }


    public function getLiveTickerResponse(): array
    {
        return [
            "data" => [
                "id" => 198003838,
                "timestamp" => "1631642077",
                "amount" => 29.77716932,
                "amount_str" => "29.77716932",
                "price" => 1.07741,
                "price_str" => "1.07741",
                "type" => 0,
                "microtimestamp" => "1631642077332000",
                "buy_order_id" => 1404137892556800,
                "sell_order_id" => 1404137888632832,
            ],
            "channel" => "live_trades_xrpusd",
            "event" => "trade"
        ];
    }
}
