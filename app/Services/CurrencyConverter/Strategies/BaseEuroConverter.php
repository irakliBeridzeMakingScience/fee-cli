<?php

namespace App\Services\CurrencyConverter\Strategies;

use App\Services\CurrencyConverter\CurrencyConverterInterface;
use Illuminate\Support\Facades\Http;

class BaseEuroConverter implements CurrencyConverterInterface
{
    public function convertTo(float $amount, string $currency): float
    {
        $data =  Http::get(config('currency.euro_converter'))->json();

        return $amount * $data['rates'][$currency];
    }

    public function convertFrom(float $amount, string $currency): float
    {
        $data =  Http::get(config('currency.euro_converter'))->json();

        return $amount / $data['rates'][$currency];

    }
}
