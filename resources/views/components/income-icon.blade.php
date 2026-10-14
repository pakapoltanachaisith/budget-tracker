@props(['category'])

@php
  use App\Enums\IncomeCategory;

  $icon = match ($category) {
      IncomeCategory::SALARY => 'ti ti-user-dollar',
      IncomeCategory::INVEST => 'ti ti-chart-line',
      IncomeCategory::BUSINESS => 'ti ti-tie',
      IncomeCategory::INTEREST => 'ti ti-building-bank',
      IncomeCategory::EXTRA_INCOME => 'ti ti-coin',
      IncomeCategory::OTHER => 'ti ti-dots',
      default => null,
  };

  $color = match ($category) {
      IncomeCategory::SALARY => 'bg-red-200/50 text-red-900',
      IncomeCategory::INVEST => 'bg-purple-200/50 text-purple-900',
      IncomeCategory::BUSINESS => 'bg-orange-200/50 text-orange-900',
      IncomeCategory::INTEREST => 'bg-green-200/50 text-green-900',
      IncomeCategory::EXTRA_INCOME => 'bg-lime-200/50 text-lime-900',
      IncomeCategory::OTHER => 'bg-blue-200/50 text-blue-900',
      default => null,
  };
@endphp

<div @class([
    'flex items-center justify-center size-12 aspect-square rounded-lg shrink-0',
    $color,
])>
  <i @class(['text-2xl font-light', $icon])></i>
</div>
