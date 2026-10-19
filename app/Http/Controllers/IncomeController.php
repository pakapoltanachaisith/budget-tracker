<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\UpdateIncomeRequest;
use App\Models\Income;
use App\Traits\HtmxRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

class IncomeController extends Controller
{
    use HtmxRequest;

    public function index(Request $request)
    {
        $activeMonth = $request->has('month') ? Carbon::parse($request->input('month')) : Carbon::today();
        $activeCategories = $request->collect('categories');
        $searchTerm = $request->input('search');

        $query = $request
            ->user()
            ->incomes()
            ->whereMonth('date', $activeMonth->month)
            ->whereYear('date', $activeMonth->year);

        if ($activeCategories->isNotEmpty()) {
            $query->whereIn('category', $activeCategories);
        }
        if (!is_null($searchTerm) && $searchTerm !== '') {
            $query->whereLike('note', "%$searchTerm%", caseSensitive: false);
        }

        $incomes = $query
            ->latest('date')
            ->paginate(20);

        return view('incomes.index', [
            'incomes' => $incomes,
            'incomeCount' => $query->count(),
            'monthlyArray' => $this->generateMonthlyArray(),
            'activeMonth' => $activeMonth->toDateString(),
            'activeCategories' => $activeCategories,
            'searchTerm' => $searchTerm
        ])
            ->fragmentIf($this->isHxAjax(), 'list-items');
    }

    public function create()
    {
        return view('incomes.create', [
            'isHxAjax' => $this->isHxAjax(),
        ]);
    }

    public function store(StoreIncomeRequest $request)
    {
        $validated = $request->validated();
        $validated['amount'] = $validated['amount'] * 100;

        $income = $request->user()->incomes()->create($validated);

        if ($this->isHxAjax()) {
            return view('incomes.store-swap', ['income' => $income]);
        }

        return redirect()->route('incomes.index');
    }

    public function edit(Income $income)
    {
        Gate::authorize('update', $income);

        $income->amount = $income->amount / 100;

        return view('incomes.edit', [
            'income' => $income,
            'isHxAjax' => $this->isHxAjax(),
        ]);
    }

    public function update(UpdateIncomeRequest $request, Income $income)
    {
        $validated = $request->validated();

        $validated['amount'] = $validated['amount'] * 100;
        $income->update($validated);

        if ($this->isHxAjax()) {
            return view('incomes.update-swap', ['income' => $income->refresh()]);
        }

        return redirect()->route('incomes.index');
    }

    public function destroy(Income $income)
    {
        Gate::authorize('update', $income);

        $income->delete();

        if ($this->isHxAjax()) {
            return null;
        }

        return redirect()->route('incomes.index');
    }

    private function generateMonthlyArray(): Collection
    {
        $oldestIncome = request()
            ->user()
            ->incomes()
            ->oldest('date')
            ->first();

        if (!$oldestIncome) {
            return collect([]);
        }

        $from = Carbon::parse($oldestIncome->date)->startOfMonth();
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
