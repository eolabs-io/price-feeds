<?php

namespace EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Concerns;

trait LiveTickerSummarizable
{
    public function scopeWithLiveTickerSummary($query, $params)
    {
        $startTimestampMsUTC = $this->getStartTimestampMsUTC($params);
        $endTimestampMsUTC = $this->getEndTimestampMsUTC($params);
        $currencyPairs = $this->getCurrencyPairs($params);

        $query->selectRaw("
                channel as currency_pair,
                max(price) AS max_price,
                min(price) AS min_price,
                avg(price) AS avg_price,
                unix_timestamp(from_unixtime(timestamp / 1000, '%Y-%m-%d %H:%i')) AS aggregating_timestamp
        ")
        ->when(
            $startTimestampMsUTC,
            fn ($query, $startTimestampMsUTC) => $query->whereRaw("timestamp >= {$startTimestampMsUTC}")
        )
        ->when(
            $endTimestampMsUTC,
            fn ($query, $endTimestampMsUTC) => $query->whereRaw("timestamp <= {$endTimestampMsUTC}")
        )
        ->when(
            $currencyPairs,
            fn ($query, $currencyPairs) => $query->whereIn('channel', $currencyPairs)
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
