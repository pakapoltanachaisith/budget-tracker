<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $incomes = $request
            ->user()
            ->incomes()
            ->latest('transaction_date')
            ->get();

        return Inertia::render('incomes/index', [
            'incomes' => $incomes
        ]);
    }
}
