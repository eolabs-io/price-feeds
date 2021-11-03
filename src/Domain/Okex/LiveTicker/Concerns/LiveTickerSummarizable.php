<?php

namespace EolabsIo\PriceFeeds\Domain\Okex\LiveTicker\Concerns;

trait LiveTickerSummarizable
{
    public function scopeWithLiveTickerSummary($query, $params)
    {
        $startTimestampMsUTC = $this->getStartTimestampMsUTC($params);
        $endTimestampMsUTC = $this->getEndTimestampMsUTC($params);
        $currencyPairs = $this->getCurrencyPairs($params);

        $query->selectRaw("
                inst_id as currency_pair,
                max(last) AS max_price,
                min(last) AS min_price,
                avg(last) AS avg_price,
                unix_timestamp(from_unixtime(ts / 1000, '%Y-%m-%d %H:%i')) AS aggregating_timestamp
        ")
        ->when(
            $startTimestampMsUTC,
            fn ($query, $startTimestampMsUTC) => $query->whereRaw("ts >= {$startTimestampMsUTC}")
        )
        ->when(
            $endTimestampMsUTC,
            fn ($query, $endTimestampMsUTC) => $query->whereRaw("ts <= {$endTimestampMsUTC}")
        )
        ->when(
            $currencyPairs,
            fn ($query, $currencyPairs) => $query->whereIn('inst_id', $currencyPairs)
        )
        ->groupBy(
            "currency_pair",
            "aggregating_timestamp"
        )
        ->orderBy("aggregating_timestamp");
    }

    public function getStartTimestampMsUTC($params)
    {
        return data_get($params, 'startTimestampMsUTC');
    }

    public function getEndTimestampMsUTC($params)
    {
        return data_get($params, 'endTimestampMsUTC');
    }

    public function getCurrencyPairs($params)
    {
        return data_get($params, 'currencyPairs');
    }
}
