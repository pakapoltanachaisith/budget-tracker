<x-layouts.dashboard title="My Expenses">
  <x-container>
    <div class="mb-5 lg:mb-10">
      <h1 class="text-3xl font-bold">My Expenses</h1>
      <p class="text-sm font-thin mt-2">{{ $expenseCount }} {{ Str::plural('expense entry', $expenseCount) }}</p>
    </div>

    <div id="expenses-list">
      <x-expense-list :expenses="$expenses" />
    </div>

    <div class="text-center lg:text-right mt-10">
      {{ $expenses->links('components.expense-pagination') }}
    </div>
  </x-container>
</x-layouts.dashboard>
