<?php

namespace App\Services\CurrencyConverter;

interface CurrencyConverterInterface
{
    public function convertTo(float $amount, string $currency): float;

    public function convertFrom(float $amount, string $currency): float;

}
