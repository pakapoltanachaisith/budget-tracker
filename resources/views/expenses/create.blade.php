@if ($isHxAjax)
  <dialog
    id="create-expense-modal"
    class="modal"
    x-data
    x-init="$root.showModal()"
    @close="$root.remove()"
  >
    <div class="modal-box" @click.outside="$root.close()">
      <button
        type="button"
        class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
        commandfor="create-expense-modal"
        command="close"
      >
        <span class="sr-only">close</span>
        <i class="ti ti-x"></i>
      </button>
      <h3 class="text-lg font-bold">New Expense</h3>
      <x-create-expense-form hx-post="{{ route('expenses.store') }}" />
    </div>
  </dialog>
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
