<?php

namespace EolabsIo\PriceFeeds\Database\Factories\Binance;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\PriceFeeds\Domain\Binance\LiveTicker\Models\LiveTicker;

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
            'event_type' => 'trade',
            'event_time' => $timestamp,
            'symbol' => $this->faker->randomElement(['xrpusd', 'xlmusd', 'btcusd']),
            'trade_id' => $this->faker->randomNumber(5),
            'price' => $price,
            'quantity' => $amount,
            'buyer_order_id' => $this->faker->randomNumber(5),
            'seller_order_id' => $this->faker->randomNumber(5),
            'trade_time' => $timestamp,
            'buyer_is_the_market_maker' => $this->faker->boolean(),
            'ignore' => $this->faker->boolean(),
        ];
    }
}
