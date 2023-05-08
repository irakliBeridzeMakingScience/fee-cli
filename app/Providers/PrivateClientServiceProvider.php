<?php

namespace App\Providers;

use App\Services\ClientStorage\ClientStorageInterface;
use App\Services\ClientStorage\Strategies\PrivateClientWeeklyStorage;
use App\Services\CurrencyConverter\CurrencyConverterInterface;
use App\Services\CurrencyConverter\Strategies\BaseEuroConverter;
use App\Services\WithdrawalFeeCalculation\Strategies\PrivateClientWithdrawal;
use Illuminate\Support\ServiceProvider;

class PrivateClientServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->when(PrivateClientWithdrawal::class)
            ->needs(ClientStorageInterface::class)
            ->give(PrivateClientWeeklyStorage::class);

        $this->app->when(PrivateClientWeeklyStorage::class)
            ->needs(CurrencyConverterInterface::class)
            ->give(BaseEuroConverter::class);

    }

}
