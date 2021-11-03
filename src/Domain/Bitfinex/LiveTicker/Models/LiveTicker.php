<?php

namespace EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use EolabsIo\PriceFeeds\Database\Factories\Bitfinex\LiveTickerFactory;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Concerns\LiveTickerSummarizable;

class LiveTicker extends Model
{
    use HasFactory,
        LiveTickerSummarizable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bitfinex_live_tickers';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'timestamp' => 'timestamp',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'bid',
        'bid_size',
        'ask',
        'ask_size',
        'daily_change',
        'daily_change_relative',
        'last_price',
        'volume',
        'high',
        'low',
        'currency_pair',
        'timestamp',
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
