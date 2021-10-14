<?php

namespace EolabsIo\PriceFeeds\Domain\Kucoin\LiveTicker\Actions;

use EolabsIo\PriceFeeds\Domain\Shared\Actions\PersistAction;
use EolabsIo\PriceFeeds\Domain\Kucoin\LiveTicker\Models\LiveTicker;
use EolabsIo\PriceFeeds\Domain\Kucoin\Shared\Concerns\FormattsCurrencyPair;

class PersistLiveTickerAction implements PersistAction
{
    use FormattsCurrencyPair;

    private array $message;

    public function __construct(array $message)
    {
        $this->message = $message;
    }

    public function execute()
    {
        $message = $this->message['data'];
        $message['currency_pair'] = $this->getCurrencyPairFromMessage($this->message);
        $attributes = $this->mapMessageAttributes($message);

        LiveTicker::create($attributes);
    }

    public function mapMessageAttributes(array $message): array
    {
        $messageAttributeMap = $this->getMessageAttributeMap();
        $attributes = [];
        foreach ($messageAttributeMap as $key => $value) {
            $attributes[$value] = data_get($message, $key);
        }

        return $attributes;
    }

    public function getMessageAttributeMap(): array
    {
        return [
            "bestAsk" => 'best_ask',
            "bestAskSize" => 'best_ask_size',
            "bestBid" => 'best_bid',
            "bestBidSize" => 'best_bid_size',
            "price" => 'price',
            "sequence" => 'sequence',
            "size" => 'size',
            "time" => 'time',
            'currency_pair' => 'currency_pair',
        ];
    }
}
