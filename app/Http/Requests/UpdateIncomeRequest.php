<?php

namespace App\Http\Requests;

use App\Enums\IncomeCategory;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateIncomeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            'note' => ['nullable', 'string', 'max:255'],
            'transaction_date' => [
                'sometimes',
                'date',
                Rule::date()->beforeOrEqual(today()),
            ],
            'category' => ['nullable', Rule::enum(IncomeCategory::class)]
        ];
    }
}
