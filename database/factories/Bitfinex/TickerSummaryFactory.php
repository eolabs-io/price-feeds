<?php

namespace EolabsIo\PriceFeeds\Database\Factories\Bitfinex;

use Illuminate\Database\Eloquent\Factories\Factory;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Models\TickerSummary;

class TickerSummaryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TickerSummary::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $price = $this->faker->randomFloat(6, 0.25, 46743.27); //BTC on 2021.09.14

        return [
            'currency_pair' => $this->faker->randomElement(['xrpusdt', 'xlmusdt', 'btcusdt']),
            'min_price' => $price * $this->faker->randomFloat(2, 0.7, 0.9),
            'max_price' => $price,
            'avg_price' => $price * $this->faker->randomFloat(2, 1.1, 1.2),
            'aggregating_timestamp' =>$this->faker->dateTime()->getTimestamp(),
        ];
    }
}
