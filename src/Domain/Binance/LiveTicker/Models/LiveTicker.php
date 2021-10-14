<?php

namespace EolabsIo\PriceFeeds\Domain\Binance\LiveTicker\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use EolabsIo\PriceFeeds\Database\Factories\Binance\LiveTickerFactory;

class LiveTicker extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'binance_live_tickers';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'buyer_is_the_market_maker' => 'boolean',
        'ignore' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'event_type',
        'event_time',
        'symbol',
        'trade_id',
        'price',
        'quantity',
        'buyer_order_id',
        'seller_order_id',
        'trade_time',
        'buyer_is_the_market_maker',
        'ignore',
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
