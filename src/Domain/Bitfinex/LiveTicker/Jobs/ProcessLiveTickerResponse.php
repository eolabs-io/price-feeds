<?php

namespace EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Actions\PersistLiveTickerAction;

class ProcessLiveTickerResponse implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var array */
    public $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new PersistLiveTickerAction($this->message))->execute();
    }
}
