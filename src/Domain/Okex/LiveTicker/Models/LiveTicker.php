<?php

namespace EolabsIo\PriceFeeds\Domain\Okex\LiveTicker\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use EolabsIo\PriceFeeds\Database\Factories\Okex\LiveTickerFactory;
use EolabsIo\PriceFeeds\Domain\Okex\LiveTicker\Concerns\LiveTickerSummarizable;

class LiveTicker extends Model
{
    use HasFactory,
        LiveTickerSummarizable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'okex_live_tickers';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'inst_type',
        'inst_id',
        'last',
        'last_sz',
        'ask_px',
        'ask_sz',
        'bid_px',
        'bid_sz',
        'open_24h',
        'high_24h',
        'low_24h',
        'sod_utc_0',
        'sod_utc_8',
        'vol_ccy_24h',
        'vol_24h',
        'ts',
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
