<?php

namespace App\Http\Controllers;

use App\Enums\IncomeCategory;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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

    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Income::class)) {
            abort(403);
        }

        $validated = $request->validate([
            'amount' => ['required', 'decimal:0,2', 'min:0.01'],
            'note' => ['nullable', 'string', 'max:255'],
            'transaction_date' => [
                'sometimes',
                'date',
                Rule::date()->beforeOrEqual(today()),
            ],
            'category' => ['nullable', Rule::enum(IncomeCategory::class)]
        ]);

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

    public function update(Request $request, Income $income)
    {
        if ($request->user()->cannot('update', $income)) {
            abort(403);
        }

        $validated = $request->validate([
            'amount' => ['required', 'decimal:0,2', 'min:0.01'],
            'note' => ['nullable', 'string', 'max:255'],
            'transaction_date' => [
                'sometimes',
                'date',
                Rule::date()->beforeOrEqual(today()),
            ],
            'category' => ['nullable', Rule::enum(IncomeCategory::class)]
        ]);

        $income->update($validated);

        return to_route('incomes.index');
    }
}
