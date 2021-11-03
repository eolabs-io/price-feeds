<?php

namespace EolabsIo\PriceFeeds\Domain\Coinbase\LiveTicker\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use EolabsIo\PriceFeeds\Database\Factories\Coinbase\TickerSummaryFactory;

class TickerSummary extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'coinbase_ticker_summaries';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'currency_pair',
        'min_price',
        'max_price',
        'avg_price',
        'aggregating_timestamp',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return TickerSummaryFactory::new();
    }
}
