<?php

namespace EolabsIo\PriceFeeds\Domain\Okex\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Shared\Concerns\HasSummaryParams;
use EolabsIo\PriceFeeds\Domain\Okex\LiveTicker\Jobs\SummarizeLiveTicker;

class SummarizeLiveTickerCommand extends Command
{
    use HasSummaryParams;

    protected $signature = 'okex:summarize-live-ticker
                            {--start-time= : The start time for summary}
                            {--end-time= : The end time for summary}
                            {currency-pairs* : The currency pair to subscribe to i.e. XRP-USD, LTC-USD, etc}';

    protected $description = 'Summarize the Okex live ticker.';


    public function handle()
    {
        $params = $this->applyCommandSummaryParams();

        $this->info("Summarizing the Okex Live Tickers...");

        SummarizeLiveTicker::dispatch($params);
    }
}
