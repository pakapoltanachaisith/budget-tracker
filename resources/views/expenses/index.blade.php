<x-layouts.dashboard title="My Expenses">
  <x-container>
    <div class="mb-5 lg:mb-10 flex items-baseline">
      <div class="grow">
        <h1 class="text-3xl font-bold">My Expenses</h1>
        <p class="text-sm font-thin mt-2">{{ $expenseCount }} {{ Str::plural('expense entry', $expenseCount) }}</p>
      </div>
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

    <div>
      <ul id="expenses-list" class="space-y-4">
        @foreach ($expenses->items() as $expense)
          <x-expense-list-item :expense="$expense" />
        @endforeach
      </ul>
      @if ($expenses->hasMorePages())
        <div
          id="load-more"
          class="text-center py-4"
          hx-get="{{ $expenses->nextPageUrl() }}"
          hx-trigger="intersect"
        >
          <span class="htmx-indicator loading loading-dots loading-md text-primary"></span>
        </div>
      @endif
    </div>

    <noscript>
      <div class="text-center lg:text-right mt-10">
        {{ $expenses->links('components.expense-pagination') }}
      </div>
    </noscript>
  </x-container>
</x-layouts.dashboard>
