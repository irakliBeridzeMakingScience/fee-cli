<?php

namespace App\Services\WithdrawalFeeCalculation;

use  App\Enums\WithdrawalTypeEnum;
use App\Services\WithdrawalFeeCalculation\Strategies\BusinessClientWithdrawal;
use App\Services\WithdrawalFeeCalculation\Strategies\PrivateClientWithdrawal;
use Illuminate\Support\Facades\App;

final class WithdrawalFeeCalculationFactory
{
    public static function getCalculationMethod(string $client_type): WithdrawalFeeCalculationInterface
    {
        return App::make(match ($client_type) {
            WithdrawalTypeEnum::BUSINESS->value => BusinessClientWithdrawal::class,
            WithdrawalTypeEnum::PRIVATE->value => PrivateClientWithdrawal::class
        });
    }
}
