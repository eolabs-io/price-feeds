<?php
namespace EolabsIo\PriceFeeds\Domain\Shared\Concerns;

use Illuminate\Support\Carbon;

trait HasSummaryParams
{
    private $summaryParams = [
        'startTimestampMsUTC' => null,
        'endTimestampMsUTC' => null,
        'currencyPairs' => null,
    ];

    public function applyCommandSummaryParams(): array
    {
        if ($startTime = $this->option('start-time')) {
            $this->summaryParams['startTimestampMsUTC'] = Carbon::create($startTime)->getTimestampMs();
        }

        if ($endTime = $this->option('end-time')) {
            $this->summaryParams['endTimestampMsUTC'] = Carbon::create($endTime)->getTimestampMs();
        }

        if ($currencyPairs = $this->argument('currency-pairs')) {
            $this->summaryParams['currencyPairs'] = $currencyPairs;
        }

        return $this->summaryParams;
    }

    public function getSummaryParams(array $params = null): array
    {
        $params = $params ?? $this->summaryParams;

        return [
            'startTimestampMsUTC' => data_get($params, 'startTimestampMsUTC'),
            'endTimestampMsUTC' => data_get($params, 'endTimestampMsUTC'),
            'currencyPairs' => data_get($params, 'currencyPairs'),
        ];
    }
}
