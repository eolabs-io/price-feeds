<?php

namespace EolabsIo\PriceFeeds\Database\Factories\Okex;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\PriceFeeds\Domain\Okex\LiveTicker\Models\LiveTicker;

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
        $amount = $this->faker->randomFloat(8, 0, 50000);
        $timestamp = $this->faker->dateTime()->getTimestamp();

        return [
            'inst_type' => 'SPOT',
            'inst_id' =>  $this->faker->randomElement(['XRP-USDT', 'XLM-USDT', 'BTC-USDT']),
            'last' => $price,
            'last_sz'  => $amount,
            'ask_px' => $price,
            'ask_sz'  => $amount,
            'bid_px' => $price,
            'bid_sz'  => $amount,
            'open_24h' => $price,
            'high_24h' => $price,
            'low_24h' => $price,
            'sod_utc_0' => $this->faker->randomFloat(8, 0, 50000),
            'sod_utc_8' => $this->faker->randomFloat(8, 0, 50000),
            'vol_ccy_24h' => $this->faker->randomFloat(8, 0, 50000),
            'vol_24h' => $this->faker->randomFloat(8, 0, 50000),
            'ts' => $timestamp,
        ];
    }
}
