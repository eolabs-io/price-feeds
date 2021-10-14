<?php

namespace EolabsIo\PriceFeeds;

use Illuminate\Support\ServiceProvider;
use EolabsIo\PriceFeeds\Domain\Okex\LiveTicker\Command\LiveTickerCommand as OkexLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Command\LiveTickerCommand as BitrueLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Kraken\LiveTicker\Command\LiveTickerCommand as KrakenLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Kucoin\LiveTicker\Command\LiveTickerCommand as KucoinLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Binance\LiveTicker\Command\LiveTickerCommand as BinanceLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Command\LiveTickerCommand as BitfinexLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Command\LiveTickerCommand as BitstampLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Coinbase\LiveTicker\Command\LiveTickerCommand as CoinbaseLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Command\BchUsdtLiveTickerCommand as BitrueBchUsdtLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Command\BtcUsdtLiveTickerCommand as BitrueBtcUsdtLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Command\LtcUsdtLiveTickerCommand as BitrueLtcUsdtLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Command\XlmUsdtLiveTickerCommand as BitrueXlmUsdtLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Command\XrpUsdtLiveTickerCommand as BitrueXrpUsdtLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Command\BchUsdLiveTickerCommand as BitfinexBchUsdLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Command\BtcUsdLiveTickerCommand as BitfinexBtcUsdLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Command\LtcUsdLiveTickerCommand as BitfinexLtcUsdLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Command\XlmUsdLiveTickerCommand as BitfinexXlmUsdLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Command\XrpUsdLiveTickerCommand as BitfinexXrpUsdLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Bitrue\LiveTicker\Command\AlgoUsdtLiveTickerCommand as BitrueAlgoUsdtLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Command\BchUsdLiveTickerCommand as BitstampBchUsdLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Command\BtcUsdLiveTickerCommand as BitstampBtcUsdLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Command\LtcUsdLiveTickerCommand as BitstampLtcUsdLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Command\XlmUsdLiveTickerCommand as BitstampXlmUsdLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Command\XrpUsdLiveTickerCommand as BitstampXrpUsdLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Bitfinex\LiveTicker\Command\AlgoUsdLiveTickerCommand as BitfinexAlgoUsdLiveTickerCommand;
use EolabsIo\PriceFeeds\Domain\Bitstamp\LiveTicker\Command\AlgoUsdLiveTickerCommand as BitstampAlgoUsdLiveTickerCommand;

class PriceFeedsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'price-feeds');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'price-feeds');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('price-feeds.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/price-feeds'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/price-feeds'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/price-feeds'),
            ], 'lang');*/

            // Registering package commands.
            $this->commands([
                BitstampAlgoUsdLiveTickerCommand::class,
                BitstampBchUsdLiveTickerCommand::class,
                BitstampBtcUsdLiveTickerCommand::class,
                BitstampLiveTickerCommand::class,
                BitstampLtcUsdLiveTickerCommand::class,
                BitstampXlmUsdLiveTickerCommand::class,
                BitstampXrpUsdLiveTickerCommand::class,
                BitrueAlgoUsdtLiveTickerCommand::class,
                BitrueBchUsdtLiveTickerCommand::class,
                BitrueBtcUsdtLiveTickerCommand::class,
                BitrueLiveTickerCommand::class,
                BitrueLtcUsdtLiveTickerCommand::class,
                BitrueXlmUsdtLiveTickerCommand::class,
                BitrueXrpUsdtLiveTickerCommand::class,
                BitfinexAlgoUsdLiveTickerCommand::class,
                BitfinexBchUsdLiveTickerCommand::class,
                BitfinexBtcUsdLiveTickerCommand::class,
                BitfinexLiveTickerCommand::class,
                BitfinexLtcUsdLiveTickerCommand::class,
                BitfinexXlmUsdLiveTickerCommand::class,
                BitfinexXrpUsdLiveTickerCommand::class,
                CoinbaseLiveTickerCommand::class,
                BinanceLiveTickerCommand::class,
                KrakenLiveTickerCommand::class,
                KucoinLiveTickerCommand::class,
                OkexLiveTickerCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'price-feeds');

        // Register the main class to use with the facade
        $this->app->singleton('price-feeds', function () {
            return new PriceFeeds;
        });
    }
}
