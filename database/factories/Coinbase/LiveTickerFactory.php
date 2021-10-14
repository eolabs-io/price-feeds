<?php

namespace EolabsIo\PriceFeeds\Database\Factories\Coinbase;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\PriceFeeds\Domain\Coinbase\LiveTicker\Models\LiveTicker;

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
            'type' => $this->faker->text(),
            'sequence' => $this->faker->randomNumber(5),
            'product_id' => $this->faker->randomElement(['XRP-USD', 'ADA-USD', 'BTC-USD']),
            'price' => (string) $price,
            'open_24h' => (string) $price,
            'volume_24h' => (string) $amount,
            'low_24h' => (string) $price,
            'high_24h' => (string) $price,
            'volume_30d' => (string) $amount,
            'best_bid' => (string) $price,
            'best_ask' => (string) $price,
            'side'  => $this->faker->randomElement(['sell', 'buy']),
            'time' => $timestamp,
            'trade_id' => $this->faker->randomNumber(),
            'last_size' => (string) $this->faker->randomNumber(),
        ];
    }
}
