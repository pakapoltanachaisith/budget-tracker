<?php

namespace App\Http\Controllers;

use App\Enums\IncomeCategory;
use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\UpdateIncomeRequest;
use App\Models\Income;
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

        return Inertia::render('incomes/index', compact('incomes'));
    }

    public function create(Request $request)
    {
        if ($request->user()->cannot('create', Income::class)) {
            abort(403);
        }

        return Inertia::render('incomes/create', [
            'categories' => IncomeCategory::values()
        ]);
    }

    public function store(StoreIncomeRequest $request)
    {
        if ($request->user()->cannot('create', Income::class)) {
            abort(403);
        }

        $validated = $request->validated();

        $request
            ->user()
            ->incomes()
            ->create($validated);

        return to_route('incomes.index');
    }

    public function edit(Request $request, Income $income)
    {
        if ($request->user()->cannot('update', $income)) {
            abort(403);
        }

        return Inertia::render('incomes/edit', [
            'income' => $income,
            'categories' => IncomeCategory::values()
        ]);
    }

    public function update(UpdateIncomeRequest $request, Income $income)
    {
        if ($request->user()->cannot('update', $income)) {
            abort(403);
        }

        $validated = $request->validated();

        $income->update($validated);

        return to_route('incomes.index');
    }

    public function destroy(Request $request, Income $income)
    {
        if ($request->user()->cannot('delete', $income)) {
            abort(403);
        }

        $income->delete();

        return to_route('incomes.index');
    }
}
