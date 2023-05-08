<?php

namespace App\Services\WithdrawalFeeCalculation;

use App\DTOs\OperationDto;

interface WithdrawalFeeCalculationInterface
{
    public function calculateWithdrawalFee(OperationDto $operation): float;
}
