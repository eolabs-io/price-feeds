<?php

namespace EolabsIo\PriceFeeds\Tests\Feature\Kraken;

use EolabsIo\PriceFeeds\Tests\TestCase;
use EolabsIo\PriceFeeds\Domain\Kraken\LiveTicker\Models\LiveTicker;
use EolabsIo\PriceFeeds\Domain\Kraken\LiveTicker\Jobs\ProcessLiveTickerResponse;

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
        $ticker = $expected[1][0];

        $this->assertEquals($ticker[0], $liveTicker->price);
        $this->assertEquals($ticker[1], $liveTicker->volume);
        $this->assertEquals($ticker[2], $liveTicker->time);
        $this->assertEquals($ticker[3], $liveTicker->side);
        $this->assertEquals($ticker[4], $liveTicker->order_type);
        $this->assertEquals($ticker[5], $liveTicker->misc);
        $this->assertEquals($expected[3], $liveTicker->pair);
    }


    public function getLiveTickerResponse(): array
    {
        return [
                0,
                [
                  [
                    "5541.20000",
                    "0.15850568",
                    "1534614057.321597",
                    "s",
                    "l",
                    ""
                  ],
                  [
                    "6060.00000",
                    "0.02455000",
                    "1534614057.324998",
                    "b",
                    "l",
                    ""
                  ]
                ],
                "trade",
                "XBT/USD",
        ];
    }
}
