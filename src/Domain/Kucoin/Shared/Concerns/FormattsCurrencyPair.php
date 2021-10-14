<?php

namespace EolabsIo\PriceFeeds\Domain\Kucoin\Shared\Concerns;

use Illuminate\Support\Str;

trait FormattsCurrencyPair
{
    public function getCurrencyPairFromMessage(array $message): string
    {
        $topic = data_get($message, 'topic');
        $currencyPair = (string) Str::of($topic)->lower()->explode(':')[1];

        return $currencyPair;
    }

    private function listOfCurrencyPairs(array $currencyPairs): string
    {
        return array_reduce($currencyPairs, function ($carry, $item) {
            return (is_null($carry))? $item: $carry . ",". $item;
        });
    }
}
