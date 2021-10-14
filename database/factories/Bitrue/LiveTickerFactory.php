<?php

namespace EolabsIo\PriceFeeds\Database\Factories\Bitrue;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Models\LiveTicker;

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
            'id' => $this->faker->unique()->randomNumber(),
            'price' => $price,
            'amount' => $amount,
            'side' => $this->faker->randomElement(['buy', 'sell']),
            'vol' => $amount,
            'ts' => $timestamp,
            'ds' => $timestamp,
            'channel' =>  $this->faker->randomElement(['xrpusdt', 'xlmusdt', 'btcusdt']),
        ];
    }
}
