<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Traits\HtmxRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ExpenseController extends Controller
{
    use HtmxRequest;

    public function index(Request $request)
    {
        $expenses = $request
            ->user()
            ->expenses()
            ->latest()
            ->paginate(20);

        $expenseCount = $request->user()->expenses()->count();

        if ($this->isHxAjax()) {
            return view('expenses.index-swap', ['expenses' => $expenses]);
        }

        return view('expenses.index', [
            'expenses' => $expenses,
            'expenseCount' => $expenseCount
        ]);
    }

    public function create()
    {
        return view('expenses.create', [
            'isHxAjax' => $this->isHxAjax(),
        ]);
    }

    public function store(StoreExpenseRequest $request)
    {
        $validated = $request->validated();
        $validated['amount'] = $validated['amount'] * 100;

        $expense = $request->user()->expenses()->create($validated);

        if ($this->isHxAjax()) {
            return view('expenses.store-swap', ['expense' => $expense]);
        }

        return redirect()->route('expenses.index');
    }

    public function edit(Expense $expense)
    {
        Gate::authorize('update', $expense);

        $expense->amount = $expense->amount / 100;

        return view('expenses.edit', [
            'expense' => $expense,
            'isHxAjax' => $this->isHxAjax(),
        ]);
    }

    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $validated = $request->validated();

        $validated['amount'] = $validated['amount'] * 100;
        $expense->update($validated);

        if ($this->isHxAjax()) {
            return view('expenses.update-swap', ['expense' => $expense->fresh()]);
        }

        return redirect()->route('expenses.index');
    }

    public function destroy(Expense $expense)
    {
        Gate::authorize('delete', $expense);

        $expense->delete();

        if ($this->isHxAjax()) {
            return null;
        }

        return redirect()->route('expenses.index');
    }
}
