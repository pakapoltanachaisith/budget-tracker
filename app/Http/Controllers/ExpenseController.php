<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
        Gate::authorize('create', Expense::class);

        $validated = $request->validate([
            'amount' => ['required', 'decimal:0,2', 'min:0.01'],
            'note' => ['required', 'string', 'nullable', 'sometimes', 'max:255'],
            'date' => ['required', Rule::date()->beforeOrEqual(today()->toDate())]
        ]);

        $validated['amount'] = $validated['amount'] * 100;

        $request->user()->expenses()->create($validated);

        return redirect()->route('expenses.index');
    }

    public function edit(Expense $expense)
    {
        Gate::authorize('update', $expense);

        $expense->amount = $expense->amount / 100;
        return view('expenses.edit', ['expense' => $expense]);
    }

    public function update(Request $request, Expense $expense)
    {
        Gate::authorize('update', $expense);

        $validated = $request->validate([
            'amount' => ['required', 'decimal:0,2', 'min:0.01'],
            'note' => ['required', 'string', 'nullable', 'sometimes', 'max:255'],
            'date' => ['required', Rule::date()->beforeOrEqual(today()->toDate())]
        ]);

        $validated['amount'] = $validated['amount'] * 100;
        $expense->update($validated);

        return redirect()->route('expenses.index');
    }

    public function destroy(Request $request, Expense $expense)
    {
        Gate::authorize('delete', $expense);

        $expense->delete();

        if ($request->hasHeader('HX-Request') && !$request->hasHeader('HX-Boosted')) {
            return null;
        }

        return redirect()->route('expenses.index');
    }
}
