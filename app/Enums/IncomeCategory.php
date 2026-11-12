<?php

namespace App\Enums;

enum IncomeCategory: string
{
    case SALARY = 'salary';
    case INVEST = 'invest';
    case BUSINESS = 'business';
    case INTEREST = 'interest';
    case EXTRA_INCOME = 'extra income';
    case OTHER = 'other';
}
