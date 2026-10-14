<?php

namespace App\Http\Controllers;

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
            ->latest()
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
        return view('incomes.create');
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
