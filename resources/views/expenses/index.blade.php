<x-layouts.dashboard title="My Expenses">
  <x-container>
    {{-- Header --}}
    <div class="mb-5 lg:mb-10 flex items-baseline">
      <div class="grow">
        <h1 class="text-3xl font-bold">My Expenses</h1>
        <p class="text-sm font-thin mt-2">{{ $expenseCount }} {{ Str::plural('expense entry', $expenseCount) }}</p>
      </div>
      <div>
        <x-expense-filters-modal
          :monthlyArray="$monthlyArray"
          :activeMonth="$activeMonth"
          :activeCategories="$activeCategories"
          :searchTerm="$searchTerm"
        />
        <a
          href="{{ route('expenses.create') }}"
          class="btn btn-neutral"
          hx-get="{{ route('expenses.create') }}"
          hx-target="#modal"
        >
          Add
          <i class="ti ti-plus"></i>
        </a>
      </div>
    </div>

    {{-- Expense List and Filters --}}
    <div class="grid grid-cols-3 gap-5">
      <div class="col-span-3 lg:col-span-2">
        <ul id="expenses-list" class="space-y-4">
          @fragment('list-items')
            @foreach ($expenses as $expense)
              @if ($expenses->hasMorePages() && $expenses->count() === $loop->iteration)
                <x-expense-list-item
                  :expense="$expense"
                  hx-get="{{ $expenses->nextPageUrl() }}"
                  hx-target="this"
                  hx-swap="afterend"
                  hx-trigger="intersect"
                />
              @else
                <x-expense-list-item :expense="$expense" />
              @endif
            @endforeach
          @endfragment
        </ul>
      </div>

      <div class="hidden lg:block self-start bg-base-100 p-4 shadow rounded-box">
        <h3 class="text-neutral-500 text-xs font-medium">Filters</h3>
        <x-expenses-filters
          :monthlyArray="$monthlyArray"
          :activeMonth="$activeMonth"
          :activeCategories="$activeCategories"
          :searchTerm="$searchTerm"
        />
      </div>
    </div>
  </x-container>
</x-layouts.dashboard>
