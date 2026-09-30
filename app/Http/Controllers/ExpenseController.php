<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $expenses = $request
            ->user()
            ->expenses()
            ->latest()
            ->paginate(20);

        $expenseCount = $request->user()->expenses()->count();

        return view('expenses.index', [
            'expenses' => $expenses,
            'expenseCount' => $expenseCount
        ]);
    }

    public function create()
    {
        return view('expenses.create');
    }
}
