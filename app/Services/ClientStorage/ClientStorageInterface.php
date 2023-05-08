<?php

namespace App\Services\ClientStorage;

use App\DTOs\OperationDto;

interface ClientStorageInterface
{
    public function setData(OperationDto $operation): void;

    public function getData(OperationDto $operation): array;

}
