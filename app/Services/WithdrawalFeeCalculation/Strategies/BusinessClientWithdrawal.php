<?php

namespace App\Services\WithdrawalFeeCalculation\Strategies;

use App\DTOs\OperationDto;
use App\Enums\BusinessClientRulesEnum;
use App\Services\WithdrawalFeeCalculation\WithdrawalFeeCalculationInterface;

final class BusinessClientWithdrawal implements WithdrawalFeeCalculationInterface
{
    public function calculateWithdrawalFee(OperationDto $operation): float
    {
        return BusinessClientRulesEnum::WITHDRAW_RATE * $operation->transferAmmout;
    }
}
