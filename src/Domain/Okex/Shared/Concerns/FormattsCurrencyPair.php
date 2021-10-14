<?php

namespace EolabsIo\PriceFeeds\Domain\Okex\Shared\Concerns;

trait FormattsCurrencyPair
{
    private function listOfCurrencyPairs(array $currencyPairs): string
    {
        return array_reduce($currencyPairs, function ($carry, $item) {
            return (is_null($carry))? $item: $carry . ",". $item;
        });
    }
}
