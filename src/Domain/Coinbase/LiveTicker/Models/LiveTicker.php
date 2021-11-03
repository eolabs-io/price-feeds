<?php

namespace EolabsIo\PriceFeeds\Domain\Coinbase\LiveTicker\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use EolabsIo\PriceFeeds\Database\Factories\Coinbase\LiveTickerFactory;
use EolabsIo\PriceFeeds\Domain\Coinbase\LiveTicker\Concerns\LiveTickerSummarizable;

class LiveTicker extends Model
{
    use HasFactory,
        LiveTickerSummarizable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'coinbase_live_tickers';


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'type',
        'sequence',
        'product_id',
        'price',
        'open_24h',
        'volume_24h',
        'low_24h',
        'high_24h',
        'volume_30d',
        'best_bid',
        'best_ask',
        'side',
        'time',
        'trade_id',
        'last_size',
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
