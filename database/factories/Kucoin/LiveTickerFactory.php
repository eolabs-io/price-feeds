<?php

namespace EolabsIo\PriceFeeds\Database\Factories\Kucoin;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\PriceFeeds\Domain\Kucoin\LiveTicker\Models\LiveTicker;

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
        $timestamp = now()->getTimestampMs();

        return [
            'best_ask' => $this->faker->randomNumber(5),
            'best_ask_size' => $this->faker->randomNumber(5),
            'best_bid' => $price,
            'best_bid_size' => $this->faker->randomNumber(5),
            'price' => $price,
            'sequence' => $this->faker->randomNumber(5),
            'size' => $amount,
            'time' => $timestamp,
            'currency_pair' => $this->faker->randomElement(['XRP-USD', 'ADA-USD', 'BTC-USD']),
        ];
    }
}
