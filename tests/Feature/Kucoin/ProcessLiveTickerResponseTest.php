<?php

namespace EolabsIo\PriceFeeds\Tests\Feature\Kucoin;

use EolabsIo\PriceFeeds\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\PriceFeeds\Domain\Kucoin\LiveTicker\Models\LiveTicker;
use EolabsIo\PriceFeeds\Domain\Kucoin\LiveTicker\Jobs\ProcessLiveTickerResponse;

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

        $this->assertEquals(data_get($expected, 'data.sequence'), $liveTicker->sequence);
        $this->assertEquals(data_get($expected, 'data.price'), $liveTicker->price);
        $this->assertEquals(data_get($expected, 'data.size'), $liveTicker->size);
        $this->assertEquals(data_get($expected, 'data.bestAsk'), $liveTicker->best_ask);
        $this->assertEquals(data_get($expected, 'data.bestAskSize'), $liveTicker->best_ask_size);
        $this->assertEquals(data_get($expected, 'data.bestBid'), $liveTicker->best_bid);
        $this->assertEquals(data_get($expected, 'data.bestBidSize'), $liveTicker->best_bid_size);
        $this->assertEquals('btc-usdt', $liveTicker->currency_pair);
    }


    public function getLiveTickerResponse(): array
    {
        return [
                "type" => "message",
                "topic" => "/market/ticker:BTC-USDT",
                "subject" => "trade.ticker",
                "data" => [
                    "sequence" => "1545896668986", // Sequence number
                    "price" => "0.08",             // Last traded price
                    "size" => "0.011",             //  Last traded amount
                    "bestAsk" => "0.08",          // Best ask price
                    "bestAskSize" => "0.18",      // Best ask size
                    "bestBid" => "0.049",         // Best bid price
                    "bestBidSize" => "0.036",     // Best bid size
                    "time" => 1632250711344,
                ]
        ];
    }
}
