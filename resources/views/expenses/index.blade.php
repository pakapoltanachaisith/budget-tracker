<x-layouts.dashboard title="My Expenses">
  <div class="mb-5 lg:mb-10">
    <h1 class="text-3xl font-bold">My Expenses</h1>
  </div>

  <div>
    <x-expenses-table :expenses="$expenses" />
  </div>
</x-layouts.dashboard>
