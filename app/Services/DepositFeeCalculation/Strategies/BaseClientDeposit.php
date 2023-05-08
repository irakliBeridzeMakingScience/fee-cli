<?php

namespace App\Services\DepositFeeCalculation\Strategies;

use App\DTOs\OperationDto;
use App\Services\DepositFeeCalculation\DepositFeeCalculationInterface;
use App\Enums\DepositRulesEnum;

final class BaseClientDeposit implements DepositFeeCalculationInterface
{
    public function calculateDepositFee(OperationDto $operation): float
    {
        return DepositRulesEnum::CHARGE_RATE * $operation->transferAmmout;
    }
}
