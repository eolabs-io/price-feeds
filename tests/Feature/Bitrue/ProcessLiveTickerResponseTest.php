<?php

namespace EolabsIo\PriceFeeds\Tests\Feature\Bitrue;

use EolabsIo\PriceFeeds\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Models\LiveTicker;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Jobs\ProcessLiveTickerResponse;

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
        $liveTicker = LiveTicker::where('id', 20482764)->first();
        $expected = $this->getLiveTickerResponse();

        $this->assertEquals(data_get($expected, 'tick.data.0.id'), $liveTicker->id);
        $this->assertEquals(data_get($expected, 'tick.data.0.price'), $liveTicker->price);
        $this->assertEquals(data_get($expected, 'tick.data.0.amount'), $liveTicker->amount);
        $this->assertEquals(data_get($expected, 'tick.data.0.side'), $liveTicker->side);
        $this->assertEquals(data_get($expected, 'tick.data.0.vol'), $liveTicker->vol);
        $this->assertEquals(data_get($expected, 'tick.data.0.ts'), $liveTicker->ts);
        $this->assertEquals(data_get($expected, 'tick.data.0.ds'), $liveTicker->ds);
        $this->assertEquals('ltcbtc', $liveTicker->channel);
    }


    public function getLiveTickerResponse(): array
    {
        return [
            "channel" => "market_ltcbtc_trade_ticker",
            "tick" => [
                "data" => [
                    [
                        "id" => 20482764,
                        "price" => 0.006277,
                        "amount" => 0.00520991,
                        "side" => "BUY",
                        "vol" => 0.83,
                        "ts" => 1621426164263,
                        "ds" => "2021-05-19 20:09:24"
                    ],
                    [
                        "id" => 20482763,
                        "price" => 0.006278,
                        "amount" => 0.00018834,
                        "side" => "SELL",
                        "vol" => 0.03,
                        "ts" => 1621426160884,
                        "ds" => "2021-05-19 20:09:20"
                    ]
                ]
            ],
            "ts" => 1621426164471,
        ];
    }
}
