<?php

namespace EolabsIo\PriceFeeds\Tests\Feature\Kraken;

use Illuminate\Support\Carbon;
use EolabsIo\PriceFeeds\Tests\TestCase;
use EolabsIo\PriceFeeds\Domain\Kraken\LiveTicker\Models\LiveTicker;
use EolabsIo\PriceFeeds\Domain\Kraken\LiveTicker\Models\TickerSummary;
use EolabsIo\PriceFeeds\Domain\Kraken\LiveTicker\Jobs\SummarizeLiveTicker;

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
            'currencyPairs' => ['XRP/USD'],
        ];

        (new SummarizeLiveTicker($params))->handle();

        $tickerSummary = TickerSummary::first();

        $this->assertEquals('XRP/USD', $tickerSummary->currency_pair);
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
            'pair' => 'XRP/USD',
            'price' => 1.13586,
            'time' => $oneHourPlus2Ago->getTimestampMs(),
        ]);

        LiveTicker::factory()->create([
            'pair' => 'XRP/USD',
            'price' => 1.13388,
            'time' => $oneHourPlusAgo->getTimestampMs(),
        ]);

        LiveTicker::factory()->create([
            'pair' => 'XRP/USD',
            'price' => 1.12199,
            'time' => $oneHourAgo->getTimestampMs(),
        ]);

        // Should not be summartized
        LiveTicker::factory()->create([
            'pair' => 'XRP/USD',
            'price' => 1.11399,
            'time' => $oneMinAgo->getTimestampMs(),
        ]);

        LiveTicker::factory()->create([
            'pair' => 'XRP/USD',
            'price' => 1.12099,
            'time' => $now->getTimestampMs(),
        ]);
    }
}
