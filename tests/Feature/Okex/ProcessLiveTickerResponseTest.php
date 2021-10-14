<?php

namespace EolabsIo\PriceFeeds\Tests\Feature\Okex;

use EolabsIo\PriceFeeds\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\PriceFeeds\Domain\Okex\LiveTicker\Models\LiveTicker;
use EolabsIo\PriceFeeds\Domain\Okex\LiveTicker\Jobs\ProcessLiveTickerResponse;

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

        $this->assertEquals(data_get($expected, '0.instType'), $liveTicker->inst_type);
        $this->assertEquals(data_get($expected, '0.instId'), $liveTicker->inst_id);
        $this->assertEquals(data_get($expected, '0.last'), $liveTicker->last);
        $this->assertEquals(data_get($expected, '0.lastSz'), $liveTicker->last_sz);
        $this->assertEquals(data_get($expected, '0.askPx'), $liveTicker->ask_px);
        $this->assertEquals(data_get($expected, '0.askSz'), $liveTicker->ask_sz);
        $this->assertEquals(data_get($expected, '0.bidPx'), $liveTicker->bid_px);
        $this->assertEquals(data_get($expected, '0.bidSz'), $liveTicker->bid_sz);
        $this->assertEquals(data_get($expected, '0.open24h'), $liveTicker->open_24h);
        $this->assertEquals(data_get($expected, '0.high24h'), $liveTicker->high_24h);
        $this->assertEquals(data_get($expected, '0.low24h'), $liveTicker->low_24h);
        $this->assertEquals(data_get($expected, '0.sodUtc0'), $liveTicker->sod_utc_0);
        $this->assertEquals(data_get($expected, '0.sodUtc8'), $liveTicker->sod_utc_8);
        $this->assertEquals(data_get($expected, '0.volCcy24h'), $liveTicker->vol_ccy_24h);
        $this->assertEquals(data_get($expected, '0.vol24h'), $liveTicker->vol_24h);
        $this->assertEquals(data_get($expected, '0.ts'), $liveTicker->ts);
    }


    public function getLiveTickerResponse(): array
    {
        return [
            [
                "instType" => "SPOT",
                "instId" => "XRP-USDT",
                "last" => 1.09957,
                "lastSz" => 654.357562,
                "askPx" => 1.09985,
                "askSz" => 332,
                "bidPx" => 1.09941,
                "bidSz" => 332,
                "open24h" => 1.12413,
                "high24h" => 1.1388,
                "low24h" => 1.0629,
                "sodUtc0" => 1.13605,
                "sodUtc8" => 1.10066,
                "volCcy24h" => 55321370.36527,
                "vol24h" => 50426081.325042,
                "ts" => 1634076268286,
            ]
        ];
    }
}
