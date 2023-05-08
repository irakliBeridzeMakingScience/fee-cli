<?php

namespace App\Enums;

enum PrivateClientRulesEnum
{
    public const BASE_CURRENCY = 'EUR';
    public const MAX_CHARGELESS_WITHDRAW = 3;
    public const WITHDRAW_RATE = 0.3 / 100;
    public const MAX_CHARGELESS_AMOUNT = 1000;
}
