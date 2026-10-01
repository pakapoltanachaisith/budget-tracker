<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => ['required', 'decimal:0,2', 'min:0.01'],
            'note' => ['required', 'string', 'nullable', 'sometimes', 'max:255'],
            'date' => ['required', Rule::date()->beforeOrEqual(today()->toDate())]
        ]);

        $validated['amount'] = $validated['amount'] * 100;

        $request->user()->expenses()->create($validated);

        return redirect()->route('expenses.index');
    }
}
