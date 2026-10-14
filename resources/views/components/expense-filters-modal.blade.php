@props(['monthlyArray', 'activeMonth', 'activeCategories', 'searchTerm'])

@php
  use Illuminate\Support\Carbon;
  use App\Enums\ExpenseCategory;

  $categories = ExpenseCategory::cases();
@endphp

<button
  type="button"
  class="btn btn-square btn-neutral btn-soft mr-2 lg:hidden"
  command="show-modal"
  commandfor="filter-expense-modal"
>
  <span class="sr-only">open filter modal</span>
  <i class="ti ti-filter"></i>
</button>

<dialog
  id="filter-expense-modal"
  class="modal"
  x-init="$root.showModal()"
  @close="$root.remove()"
>
  <div class="modal-box" @click.outside="$root.close()">
    <button
      type="button"
      class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
      commandfor="filter-expense-modal"
      command="close"
    >
      <span class="sr-only">close</span>
      <i class="ti ti-x"></i>
    </button>
    <h3 class="text-lg font-bold">Filters</h3>
    <form action="{{ route('expenses.index') }}" method="GET">
      {{-- Inputs --}}
      <div>
        <div class="fieldset">
          <label for="mobile-search" class="fieldset-legend">Search</label>
          <div class="input input-sm w-full">
            <i class="ti ti-search"></i>
            <input
              type="search"
              name="search"
              id="mobile-search"
              class="grow"
              value="{{ $searchTerm ?? '' }}"
            >
          </div>
        </div>
        <div class="fieldset">
          <label for="mobile-month" class="fieldset-legend">Month</label>
          <select
            name="month"
            id="mobile-month"
            class="select select-sm w-full"
          >
            @foreach ($monthlyArray as $month)
              <option value="{{ $month }}" @selected($activeMonth === $month)>
                {{ Carbon::parse($month)->format('M Y') }}
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
      <div class="mt-5 grid grid-cols-2 gap-3">
        <button type="submit" class="btn btn-sm btn-primary">Apply Filter</button>
        <a href="{{ route('expenses.index') }}" class="btn btn-sm">Remove Filters</a>
      </div>
    </form>
  </div>
</dialog>
