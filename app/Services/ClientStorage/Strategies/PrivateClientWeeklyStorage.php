<?php

namespace App\Services\ClientStorage\Strategies;

use App\DTOs\OperationDto;
use App\Services\ClientStorage\ClientStorageInterface;
use App\Services\CurrencyConverter\CurrencyConverterInterface;
use App\Enums\PrivateClientRulesEnum;

final class PrivateClientWeeklyStorage implements ClientStorageInterface
{
    private static array $transactionData = [];

    private static ?string $startOfWeek = 'foo';

    public function __construct(private CurrencyConverterInterface $converter)
    {
    }

    public function setData(OperationDto $operation): void
    {
        $operationsWeekStart = $operation->date->startOfWeek()->format('Y-m-d');

        //Clear the data when new week starts
        if ($operationsWeekStart !== self::$startOfWeek) {
            self::$startOfWeek = $operationsWeekStart;
            self::$transactionData = [];
        }


        /* Avoiding convertion call when not needed
         * In case currency changes
         * Change it in enum and bind proper convertion service in Service provider */
        if (PrivateClientRulesEnum::BASE_CURRENCY !== $operation->currency) {
            $transfer = $this->converter->convertFrom($operation->transferAmmout, $operation->currency);
        } else {
            $transfer = $operation->transferAmmout;
        }

        $clientData = &self::$transactionData[$operation->user_id] ?? null;

        if ($clientData === null) {
            $clientData['count'] = 1;
            $clientData['chargeless'] = PrivateClientRulesEnum::MAX_CHARGELESS_AMOUNT - $transfer;
            $clientData['chargeable'] = 0;
        } else {
            $clientData['count']++;
            $clientData['chargeless'] -= $transfer;
        }


        /*
         *  If chargless goes below zero means client have hit the limit, so convert the remainder
         *  In the end we set chargeless to zero so future transactions will still apply to same rule
         * */

        if ($clientData['chargeless'] < 0) {
            $charge = abs($clientData['chargeless']);

            if (PrivateClientRulesEnum::BASE_CURRENCY !== $operation->currency) {
                $charge = $this->converter->convertTo($charge, $operation->currency);
            }


            $clientData['chargeable'] = $charge;
            $clientData['chargeless'] = 0;

        }


    }

    public function getData(OperationDto $operation): array
    {
        return self::$transactionData[$operation->user_id];
    }
}
