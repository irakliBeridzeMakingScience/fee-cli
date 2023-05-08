<?php

namespace App\Services\WithdrawalFeeCalculation\Strategies;

use App\DTOs\OperationDto;
use App\Enums\PrivateClientRulesEnum;
use App\Services\ClientStorage\ClientStorageInterface;
use App\Services\WithdrawalFeeCalculation\WithdrawalFeeCalculationInterface;

final class PrivateClientWithdrawal implements WithdrawalFeeCalculationInterface
{
    public function __construct(
        private ClientStorageInterface $storage
    ) {
    }

    public function calculateWithdrawalFee(OperationDto $operation): float
    {
        $this->storage->setData($operation);

        $data = $this->storage->getData($operation);

        if ($data['count'] > PrivateClientRulesEnum::MAX_CHARGELESS_WITHDRAW || $data['chargeable'] > 0) {
            return PrivateClientRulesEnum::WITHDRAW_RATE * $data['chargeable'];
        }

        return 0;
    }
}
