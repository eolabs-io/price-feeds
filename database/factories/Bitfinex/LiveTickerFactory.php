<?php

namespace EolabsIo\PriceFeeds\Database\Factories\Bitfinex;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Models\LiveTicker;

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
        $timestamp = $this->faker->dateTime()->getTimestamp();

        return [
            'bid' => $this->faker->randomFloat(5),
            'bid_size' => $this->faker->randomFloat(5),
            'ask' => $this->faker->randomFloat(5),
            'ask_size' => $this->faker->randomFloat(5),
            'daily_change' => $this->faker->randomFloat(5),
            'daily_change_relative' => $this->faker->randomFloat(5),
            'last_price' => $this->faker->randomFloat(5),
            'volume' => $this->faker->randomFloat(5),
            'high' => $this->faker->randomFloat(5),
            'low' => $this->faker->randomFloat(5),
            'currency_pair' => $this->faker->randomElement(['XRPUSD', 'BTCUSD']),
            'timestamp' => $timestamp,
        ];
    }
}
