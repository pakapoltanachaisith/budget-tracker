<?php

namespace App\Enums;

enum ExpenseCategory: string
{
    case FOOD = 'food';
    case SOCIAL = 'social';
    case TRAFFIC = 'traffic';
    case SHOPPING = 'shopping';
    case GROCERY = 'grocery';
    case EDUCATION = 'education';
    case BILLS = 'bills';
    case RENTALS = 'rentals';
    case MEDICAL = 'medical';
    case INVESTMENT = 'investment';
    case GIFT = 'gift';
    case OTHER = 'other';
}
