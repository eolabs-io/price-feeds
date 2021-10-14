<?php

namespace EolabsIo\PriceFeeds\Database\Factories\Bitstamp;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Models\LiveTicker;

class LiveTickerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LiveTicker::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $price = $this->faker->randomFloat(8, 0.25, 46743.27); //BTC on 2021.09.14
        $amount = $this->faker->randomNumber(8);
        $timestamp = $this->faker->dateTime()->getTimestamp();

        return [
            'id' => $this->faker->unique()->randomNumber(5),
            'amount' => (float) $amount,
            'amount_str' => (string) $amount,
            'price' => (float) $price,
            'price_str' => (string) $price,
            'type' => $this->faker->randomElement([0,1]),
            'timestamp' => $timestamp,
            'microtimestamp' => $timestamp * 1000000,
            'buy_order_id' => $this->faker->randomNumber(5),
            'sell_order_id' => $this->faker->randomNumber(5),
            'channel' => $this->faker->randomElement(['live_trades_xrpusd', 'live_trades_btcusd']),
        ];
    }
}
