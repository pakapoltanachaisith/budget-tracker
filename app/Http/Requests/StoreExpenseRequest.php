<?php

namespace App\Http\Requests;

use App\Enums\ExpenseCategory;
use App\Models\Expense;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\Attributes\RedirectToRoute;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

#[RedirectToRoute('expenses.create')]
class StoreExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Expense::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amount' => ['required', 'decimal:0,2', 'min:0.01'],
            'note' => ['string', 'nullable', 'sometimes', 'max:255'],
            'date' => ['required', Rule::date()->beforeOrEqual(today()->toDate())],
            'category' => ['required', Rule::enum(ExpenseCategory::class)],
        ];
    }
}
