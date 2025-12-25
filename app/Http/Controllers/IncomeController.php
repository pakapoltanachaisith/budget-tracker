<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->cannot('create', Income::class)) {
            return to_route('home');
        }

        return Inertia::render('incomes/Index');
    }

    public function create(Request $request)
    {
        if ($request->user()->cannot('create', Income::class)) {
            return to_route('home');
        }

        return Inertia::render('incomes/Create');
    }

    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Income::class)) {
            return to_route('home');
        }

        $validated = $request->validate(rules: [
            'note' => ['string', 'nullable', 'max:255'],
            'amount' => ['required', 'decimal:0,2', 'min:0.01']
        ]);

        $amount = (int) ((float) $validated['amount'] * 100);

        $request->user()->incomes()->create([
            ...$validated,
            'amount' => $amount
        ]);

        return to_route('incomes.index');
    }
}
