<?php
namespace EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Command;

use Illuminate\Console\Command;
use EolabsIo\PriceFeeds\Domain\Shared\Concerns\HasSummaryParams;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Jobs\SummarizeLiveTicker;

class SummarizeLiveTickerCommand extends Command
{
    use HasSummaryParams;

    protected $signature = 'bitfinex:summarize-live-ticker
                            {--start-time= : The start time for summary}
                            {--end-time= : The end time for summary}
                            {currency-pairs* : The currency pair to subscribe to i.e. xrpusdt, ltcusdt, etc}';

    protected $description = 'Summarize the Bitfinex live ticker.';


    public function handle()
    {
        $params = $this->applyCommandSummaryParams();

        $this->info("Summarizing the Bitfinex Live Tickers...");

        SummarizeLiveTicker::dispatch($params);
    }
}
