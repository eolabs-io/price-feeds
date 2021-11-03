<?php

namespace EolabsIo\PriceFeeds\Domain\Kraken\LiveTicker\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use EolabsIo\PriceFeeds\Database\Factories\Kraken\LiveTickerFactory;
use EolabsIo\PriceFeeds\Domain\Kraken\LiveTicker\Concerns\LiveTickerSummarizable;

class LiveTicker extends Model
{
    use HasFactory,
        LiveTickerSummarizable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kraken_live_tickers';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'price',
        'volume',
        'time',
        'side',
        'order_type',
        'misc',
        'pair',
    ];


    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return LiveTickerFactory::new();
    }
}
