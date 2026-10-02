<x-layouts.dashboard title="Edit Expense">
  <x-container>
    <div class="mb-5 lg:mb-10">
      <h1 class="text-3xl font-bold">Edit Expense</h1>
    </div>

    <div>
      <x-edit-expense-form :expense="$expense" />
    </div>
  </x-container>
</x-layouts.dashboard>
