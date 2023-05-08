<?php

namespace App\Services\CurrencyConverter\Strategies;

use App\Services\CurrencyConverter\CurrencyConverterInterface;
use Illuminate\Support\Facades\Http;

class BaseEuroConverter implements CurrencyConverterInterface
{
    private string $apiURL = 'https://developers.paysera.com/tasks/api/currency-exchange-rates';

    public function convertTo(float $amount, string $currency): float
    {
        $data =  Http::get($this->apiURL)->json();

        return $amount * $data['rates'][$currency];
    }

    public function convertFrom(float $amount, string $currency): float
    {
        $data =  Http::get($this->apiURL)->json();

        return $amount / $data['rates'][$currency];

    }
}
