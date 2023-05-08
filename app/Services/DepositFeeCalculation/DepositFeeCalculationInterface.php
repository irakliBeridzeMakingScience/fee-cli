<?php

namespace App\Services\DepositFeeCalculation;

use App\DTOs\OperationDto;

interface DepositFeeCalculationInterface
{
    public function calculateDepositFee(OperationDto $operation): float;
}
