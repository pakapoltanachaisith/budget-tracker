<?php

namespace App\Enums;

enum IncomeCategory: string
{
    case SALARY = 'salary';
    case INVEST = 'invest';
    case BUSINESS = 'business';
    case INTEREST = 'interest';
    case OTHER = 'other';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
