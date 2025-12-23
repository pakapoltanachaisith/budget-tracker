<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class IncomeController extends Controller
{
    public function index()
    {
        return Inertia::render('incomes/Index');
    }

    public function create()
    {
        return Inertia::render('incomes/Create');
    }

    public function store(Request $request)
    {
        dd($request);
    }
}
