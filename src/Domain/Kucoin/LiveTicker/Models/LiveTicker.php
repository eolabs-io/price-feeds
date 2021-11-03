<?php

namespace EolabsIo\PriceFeeds\Domain\Kucoin\LiveTicker\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use EolabsIo\PriceFeeds\Database\Factories\Kucoin\LiveTickerFactory;
use EolabsIo\PriceFeeds\Domain\Kucoin\LiveTicker\Concerns\LiveTickerSummarizable;

class LiveTicker extends Model
{
    use HasFactory,
        LiveTickerSummarizable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kucoin_live_tickers';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'best_ask',
        'best_ask_size',
        'best_bid',
        'best_bid_size',
        'price',
        'sequence',
        'size',
        'time',
        'currency_pair',
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
