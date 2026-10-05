@props(['category'])

@php
  use App\Enums\ExpenseCategory;

  $icon = match ($category) {
      ExpenseCategory::FOOD => 'ti ti-soup',
      ExpenseCategory::SOCIAL => 'ti ti-glass-full',
      ExpenseCategory::TRAFFIC => 'ti ti-car',
      ExpenseCategory::SHOPPING => 'ti ti-shopping-bag',
      ExpenseCategory::GROCERY => 'ti ti-basket',
      ExpenseCategory::EDUCATION => 'ti ti-school',
      ExpenseCategory::BILLS => 'ti ti-receipt-2',
      ExpenseCategory::RENTALS => 'ti ti-home-dot',
      ExpenseCategory::MEDICAL => 'ti ti-building-hospital',
      ExpenseCategory::INVESTMENT => 'ti ti-chart-dots-2',
      ExpenseCategory::GIFT => 'ti ti-gift',
      ExpenseCategory::OTHER => 'ti ti-dots',
      default => null,
  };

  $color = match ($category) {
      ExpenseCategory::FOOD => 'bg-red-200/50 text-red-900',
      ExpenseCategory::SOCIAL => 'bg-purple-200/50 text-purple-900',
      ExpenseCategory::TRAFFIC => 'bg-orange-200/50 text-orange-900',
      ExpenseCategory::SHOPPING => 'bg-green-200/50 text-green-900',
      ExpenseCategory::GROCERY => 'bg-lime-200/50 text-lime-900',
      ExpenseCategory::EDUCATION => 'bg-blue-200/50 text-blue-900',
      ExpenseCategory::BILLS => 'bg-yellow-200/50 text-yellow-900',
      ExpenseCategory::RENTALS => 'bg-pink-200/50 text-pink-900',
      ExpenseCategory::MEDICAL => 'bg-cyan-200/50 text-cyan-900',
      ExpenseCategory::INVESTMENT => 'bg-amber-200/50 text-amber-900',
      ExpenseCategory::GIFT => 'bg-rose-200/50 text-rose-900',
      ExpenseCategory::OTHER => 'bg-slate-200/50 text-slate-900',
      default => null,
  };
@endphp

<div @class([
    'flex items-center justify-center size-12 aspect-square rounded-lg shrink-0',
    $color,
])>
  <i @class(['text-2xl font-light', $icon])></i>
</div>
