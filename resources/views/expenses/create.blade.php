@if ($isHxAjax)
  <x-modal
    id="create-expense-modal"
    x-data
    x-init="$root.showModal()"
    @close="$root.remove()"
  >
    <div @click.outside="$root.close()">
      <h3 class="text-lg font-bold">New Expense</h3>
      <x-create-expense-form hx-post="{{ route('expenses.store') }}" />
    </div>
  </x-modal>
@else
  <x-layouts.dashboard title="Add Expenses">
    <x-container>
      <div class="mb-5 lg:mb-10">
        <h1 class="text-3xl font-bold">Add Expenses</h1>
      </div>

      <div>
        <x-create-expense-form />
      </div>
    </x-container>
  </x-layouts.dashboard>
@endif
