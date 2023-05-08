<?php

namespace App\Services\DepositFeeCalculation;

use App\Services\DepositFeeCalculation\Strategies\BaseClientDeposit;

final class DepositFeeCalculationFactory
{
    public static function getCalculationMethod(): DepositFeeCalculationInterface
    {
        return new BaseClientDeposit();
    }
}
