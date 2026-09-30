<x-layouts.dashboard title="My Expenses">
  <div class="w-[90%] mx-auto max-w-200">
    <div class="mb-5 lg:mb-10">
      <h1 class="text-3xl font-bold">My Expenses</h1>
    </div>

    <div>
      <x-expense-list :expenses="$expenses" />
    </div>
  </div>
</x-layouts.dashboard>
