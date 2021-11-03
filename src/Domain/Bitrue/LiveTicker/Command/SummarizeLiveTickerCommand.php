<?php

namespace EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Shared\Concerns\HasSummaryParams;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Jobs\SummarizeLiveTicker;

class SummarizeLiveTickerCommand extends Command
{
    use HasSummaryParams;

    protected $signature = 'bitrue:summarize-live-ticker
                            {--start-time= : The start time for summary}
                            {--end-time= : The end time for summary}
                            {currency-pairs* : The currency pair to subscribe to i.e. xrpusdt, ltcusdt, etc}';

    protected $description = 'Summarize the Bitrue live ticker.';


    public function handle()
    {
        $params = $this->applyCommandSummaryParams();

        $this->info("Summarizing the Bitrue Live Tickers...");

        SummarizeLiveTicker::dispatch($params);
    }
}
