<?php

namespace EolabsIo\PriceFeeds\Database\Factories\Kraken;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\PriceFeeds\Domain\Kraken\LiveTicker\Models\LiveTicker;

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
        $timestamp = now()->toIso8601ZuluString();

        return [
            'price' => $price,
            'volume' => $amount,
            'time' => $timestamp,
            'side' => $this->faker->randomElement(['sell', 'buy']),
            'order_type' => $this->faker->randomElement(['market', 'limit']),
            'misc' => '',
            'pair' => $this->faker->randomElement(['XRP/USD', 'ADA/USD', 'BTC/USD']),
        ];
    }
}
