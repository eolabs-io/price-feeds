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
            'bid' => $this->faker->randomFloat(8, 0.25, 46743.27),
            'bid_size' => $this->faker->randomFloat(8, 0.25, 46743.27),
            'ask' => $this->faker->randomFloat(8, 0.25, 46743.27),
            'ask_size' => $this->faker->randomFloat(8, 0.25, 46743.27),
            'daily_change' => $this->faker->randomFloat(8, 0.25, 46743.27),
            'daily_change_relative' => $this->faker->randomFloat(8, 0.25, 46743.27),
            'last_price' => $this->faker->randomFloat(8, 0.25, 46743.27),
            'volume' => $this->faker->randomFloat(8, 0.25, 46743.27),
            'high' => $this->faker->randomFloat(8, 0.25, 46743.27),
            'low' => $this->faker->randomFloat(8, 0.25, 46743.27),
            'currency_pair' => $this->faker->randomElement(['XRPUSD', 'BTCUSD']),
            'timestamp' => $timestamp,
        ];
    }
}
