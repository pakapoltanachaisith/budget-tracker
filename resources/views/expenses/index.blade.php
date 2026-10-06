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
      <x-expense-list :expenses="$expenses" />
    </div>

    <div class="text-center lg:text-right mt-10">
      {{ $expenses->links('components.expense-pagination') }}
    </div>
  </x-container>
</x-layouts.dashboard>
