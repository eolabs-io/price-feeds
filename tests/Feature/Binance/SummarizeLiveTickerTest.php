<?php

namespace EolabsIo\PriceFeeds\Tests\Feature\Binance;

use Illuminate\Support\Carbon;
use EolabsIo\PriceFeeds\Tests\TestCase;
use EolabsIo\PriceFeeds\Domain\Binance\LiveTicker\Models\LiveTicker;
use EolabsIo\PriceFeeds\Domain\Binance\LiveTicker\Models\TickerSummary;
use EolabsIo\PriceFeeds\Domain\Binance\LiveTicker\Jobs\SummarizeLiveTicker;

class SummarizeLiveTickerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $knownDate = Carbon::create(2021, 10, 26, 12);
        Carbon::setTestNow($knownDate);
    }

    /** @test */
    public function it_can_summarize_live_ticker_response()
    {
        $this->seedWithLiveTickers();

        $oneHourAgo = now()->subHour(1);

        $params = [
            'endTimestampMsUTC' => $oneHourAgo->getTimestampMs(),
            'currencyPairs' => ['XRPUSDT'],
        ];

        (new SummarizeLiveTicker($params))->handle();

        $tickerSummary = TickerSummary::first();

        $this->assertEquals('XRPUSDT', $tickerSummary->currency_pair);
        $this->assertEquals(1.12199, $tickerSummary->min_price);
        $this->assertEquals(1.13586, $tickerSummary->max_price);
        $this->assertEqualsWithDelta(1.13058, $tickerSummary->avg_price, 0.00001);
        $this->assertEquals(1635245880, $tickerSummary->aggregating_timestamp);
    }

    public function seedWithLiveTickers()
    {
        $oneMinAgo = now()->subMinute(1);
        $now = now();
        $oneHourAgo = now()->subHour(1)->subMinute(1)->subSecond(10);
        $oneHourPlusAgo = now()->subHour(1)->subMinute(1)->subSecond(20);
        $oneHourPlus2Ago = now()->subHour(1)->subMinute(1)->subSecond(30);


        LiveTicker::factory()->create([
            'symbol' => 'XRPUSDT',
            'price' => 1.13586,
            'trade_time' => $oneHourPlus2Ago->getTimestampMs(),
        ]);

        LiveTicker::factory()->create([
            'symbol' => 'XRPUSDT',
            'price' => 1.13388,
            'trade_time' => $oneHourPlusAgo->getTimestampMs(),
        ]);

        LiveTicker::factory()->create([
            'symbol' => 'XRPUSDT',
            'price' => 1.12199,
            'trade_time' => $oneHourAgo->getTimestampMs(),
        ]);

        // Should not be summartized
        LiveTicker::factory()->create([
            'symbol' => 'XRPUSDT',
            'price' => 1.11399,
            'trade_time' => $oneMinAgo->getTimestampMs(),
        ]);

        LiveTicker::factory()->create([
            'symbol' => 'XRPUSDT',
            'price' => 1.12099,
            'trade_time' => $now->getTimestampMs(),
        ]);
    }
}
