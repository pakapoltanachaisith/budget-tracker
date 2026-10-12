@props(['monthlyArray', 'activeMonth', 'activeCategories'])

@php
  use Illuminate\Support\Carbon;
  use App\Enums\ExpenseCategory;

  $categories = ExpenseCategory::cases();
@endphp

<div class="bg-base-100 p-4 shadow rounded-box">
  <h3 class="text-neutral-500 text-xs font-medium">Filters</h3>
  <form action="{{ route('expenses.index') }}" method="GET">
    {{-- Inputs --}}
    <div>
      <div class="fieldset">
        <label for="month" class="fieldset-legend">Month</label>
        <select
          name="month"
          id="month"
          class="select select-sm"
        >
          @foreach ($monthlyArray as $month)
            <option value="{{ $month }}" @selected($activeMonth === $month)>{{ Carbon::parse($month)->format('M Y') }}
            </option>
          @endforeach
        </select>
      </div>
      <fieldset class="fieldset">
        <legend class="fieldset-legend">Categories</legend>
        @foreach ($categories as $category)
          <label class="label">
            <input
              type="checkbox"
              value="{{ $category }}"
              class="checkbox checkbox-xs"
              name="categories[]"
              @checked($activeCategories->contains($category->value))
            >
            {{ $category }}
          </label>
        @endforeach
      </fieldset>
    </div>

    {{-- Buttons --}}
    <div class="mt-5 space-x-2">
      <button type="submit" class="btn btn-sm btn-primary btn-soft btn-block">Apply Filter</button>
      <a href="{{ route('expenses.index') }}" class="btn btn-sm btn-block mt-1.5">Reset</a>
    </div>
  </form>
</div>
