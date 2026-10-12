<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Traits\HtmxRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

class ExpenseController extends Controller
{
    use HtmxRequest;

    public function index(Request $request)
    {
        $activeMonth = $request->has('month') ? Carbon::parse($request->input('month')) : Carbon::today();

        $expenses = $request
            ->user()
            ->expenses()
            ->whereMonth('date', $activeMonth->month)
            ->whereYear('date', $activeMonth->year)
            ->latest()
            ->paginate(20);

        $expenseCount = $request
            ->user()
            ->expenses()
            ->whereMonth('date', $activeMonth->month)
            ->whereYear('date', $activeMonth->year)
            ->count();

        return view('expenses.index', [
            'expenses' => $expenses,
            'expenseCount' => $expenseCount,
            'monthlyArray' => $this->generateMonthlyArray(),
            'activeMonth' => $activeMonth->toDateString()
        ])->fragmentIf($this->isHxAjax(), 'list-items');
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

    private function generateMonthlyArray(): Collection
    {
        $oldestExpense = request()
            ->user()
            ->expenses()
            ->oldest('date')
            ->first();

        if (!$oldestExpense) {
            return collect([]);
        }

        $from = Carbon::parse($oldestExpense->date)->startOfMonth();
        $to = Carbon::today()->startOfMonth();

        if ($from->isSameMonth($to)) {
            return collect([]);
        }

        $months = collect([$to->copy()]);
        while ($months->last()->greaterThan($from)) {
            $prevMonth = $months->last()->copy()->subMonth();
            $months->push($prevMonth);
        }

        return $months->map(fn($month) => $month->toDateString());
    }
}
