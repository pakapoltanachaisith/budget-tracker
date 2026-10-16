<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIncomeRequest;
use App\Traits\HtmxRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

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
