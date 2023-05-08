<?php

namespace App\DTOs;

use Carbon\Carbon;

final readonly class OperationDto
{
    public function __construct(
        public Carbon $date,
        public int $user_id,
        public string $clientType,
        public string $operationType,
        public float $transferAmmout,
        public string $currency
    ) {
    }

    public static function prepareFromCSV(array $data): OperationDto
    {
        return new self(Carbon::createFromFormat(format: 'Y-m-d', time:$data[0]), $data[1], $data[2], $data[3], $data[4], $data[5]);
    }
}
