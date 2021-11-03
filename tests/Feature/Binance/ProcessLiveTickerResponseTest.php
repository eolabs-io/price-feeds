<?php

namespace EolabsIo\PriceFeeds\Tests\Feature\Binance;

use EolabsIo\PriceFeeds\Tests\TestCase;
use EolabsIo\PriceFeeds\Domain\Binance\LiveTicker\Models\LiveTicker;
use EolabsIo\PriceFeeds\Domain\Binance\LiveTicker\Jobs\ProcessLiveTickerResponse;

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

        $this->assertEquals(data_get($expected, 'data.e'), $liveTicker->event_type);
        $this->assertEquals(data_get($expected, 'data.E'), $liveTicker->event_time);
        $this->assertEquals(data_get($expected, 'data.s'), $liveTicker->symbol);
        $this->assertEquals(data_get($expected, 'data.t'), $liveTicker->trade_id);
        $this->assertEquals(data_get($expected, 'data.p'), $liveTicker->price);
        $this->assertEquals(data_get($expected, 'data.q'), $liveTicker->quantity);
        $this->assertEquals(data_get($expected, 'data.b'), $liveTicker->buyer_order_id);
        $this->assertEquals(data_get($expected, 'data.a'), $liveTicker->seller_order_id);
        $this->assertEquals(data_get($expected, 'data.T'), $liveTicker->trade_time);
        $this->assertEquals(data_get($expected, 'data.m'), $liveTicker->buyer_is_the_market_maker);
        $this->assertEquals(data_get($expected, 'data.M'), $liveTicker->ignore);
    }


    public function getLiveTickerResponse(): array
    {
        return [
            "stream"=> "xrpusdt@trade",
            "data" => [
                "e" => "trade",     // Event type
                "E" => 123456789,   // Event time
                "s" => "BNBBTC",    // Symbol
                "t" => 12345,       // Trade ID
                "p" => "0.001",     // Price
                "q" => "100",       // Quantity
                "b" => 88,          // Buyer order ID
                "a" => 50,          // Seller order ID
                "T" => 123456785,   // Trade time
                "m" => true,        // Is the buyer the market maker?
                "M" => true         // Ignore
            ],
        ];
    }
}
