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
        return $this->user()->can('update', $this->income);
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
            'category' => ['required', Rule::enum(IncomeCategory::class)],
        ];
    }
}
