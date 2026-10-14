@props(['monthlyArray', 'activeMonth', 'activeCategories', 'searchTerm'])

@php
  use Illuminate\Support\Carbon;
  use App\Enums\ExpenseCategory;

  $categories = ExpenseCategory::cases();
@endphp

<form action="{{ route('expenses.index') }}" method="GET">
  {{-- Inputs --}}
  <div>
    <div class="fieldset">
      <label for="search" class="fieldset-legend">Search</label>
      <div class="input input-sm w-full">
        <i class="ti ti-search"></i>
        <input
          type="search"
          name="search"
          id="search"
          class="grow"
          value="{{ $searchTerm ?? '' }}"
        >
      </div>
    </div>
    <div class="fieldset">
      <label for="month" class="fieldset-legend">Month</label>
      <select
        name="month"
        id="month"
        class="select select-sm w-full"
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
  <div class="mt-5 flex lg:flex-col gap-2">
    <button type="submit" class="btn btn-sm btn-primary btn-soft">Apply Filter</button>
    <a href="{{ route('expenses.index') }}" class="btn btn-sm">Reset</a>
  </div>
</form>
