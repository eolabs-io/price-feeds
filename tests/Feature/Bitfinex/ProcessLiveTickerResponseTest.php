<?php

namespace EolabsIo\PriceFeeds\Tests\Feature\Bitfinex;

use EolabsIo\PriceFeeds\Tests\TestCase;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Models\LiveTicker;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Jobs\ProcessLiveTickerResponse;

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

        $this->assertEquals($expected[0], $liveTicker->bid);
        $this->assertEquals($expected[1], $liveTicker->bid_size);
        $this->assertEquals($expected[2], $liveTicker->ask);
        $this->assertEquals($expected[3], $liveTicker->ask_size);
        $this->assertEquals($expected[4], $liveTicker->daily_change);
        $this->assertEquals($expected[5], $liveTicker->daily_change_relative);
        $this->assertEquals($expected[6], $liveTicker->last_price);
        $this->assertEquals($expected[7], $liveTicker->volume);
        $this->assertEquals($expected[8], $liveTicker->high);
        $this->assertEquals($expected[9], $liveTicker->low);
        $this->assertEquals($expected['currency_pair'], $liveTicker->currency_pair);
        $this->assertEquals($expected['timestamp'], $liveTicker->timestamp);
    }


    public function getLiveTickerResponse(): array
    {
        return [
            0 => 7617,
            1 => 52.98726298,
            2 => 7617.1,
            3 => 53.601795929999994,
            4 => -550.9,
            5 => -0.0674,
            6 => 7617,
            7 => 8318.92961981,
            8 => 8257.8,
            9 => 7500,
            'currency_pair' => 'XRPUSD',
            'timestamp' => now()->getTimestamp(),
        ];
    }
}
