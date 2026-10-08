@if ($isHxAjax)
  <dialog
    id="edit-expense-modal"
    class="modal"
    x-data
    x-init="$root.showModal()"
    @close="$root.remove()"
  >
    <div class="modal-box" @click.outside="$root.close()">
      <button
        type="button"
        class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
        commandfor="edit-expense-modal"
        command="close"
      >
        <span class="sr-only">close</span>
        <i class="ti ti-x"></i>
      </button>
      <h3 class="text-lg font-bold">Edit Expense</h3>
      <x-edit-expense-form :expense="$expense" hx-put="{{ route('expenses.update', [$expense]) }}" />
    </div>
  </dialog>
@else
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
@endif
