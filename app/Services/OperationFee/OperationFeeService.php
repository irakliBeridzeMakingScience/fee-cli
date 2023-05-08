<?php

namespace App\Services\OperationFee;

use App\DTOs\OperationDto;
use App\Services\DepositFeeCalculation\DepositFeeCalculationFactory;
use App\Enums\OperationEnum;
use App\Services\WithdrawalFeeCalculation\WithdrawalFeeCalculationFactory as AppWithdrawalFeeCalculationFactory;

final class OperationFeeService
{
    public function calculate(OperationDto $operation): float
    {
        $fee = match ($operation->operationType) {
            OperationEnum::WITHDRAW->value => AppWithdrawalFeeCalculationFactory::getCalculationMethod($operation->clientType)->calculateWithdrawalFee($operation),
            OperationEnum::DEPOSIT->value => DepositFeeCalculationFactory::getCalculationMethod()->calculateDepositFee($operation),
            default => 'error'
        };

        return ceil($fee * 100) / 100;
    }
}
