@if ($isHxAjax)
  <x-modal
    id="edit-income-modal"
    class="modal"
    x-data
    x-init="$root.showModal()"
    @close="$root.remove()"
  >
    <h3 class="text-lg font-bold">Edit Income</h3>
    <x-edit-income-form :income="$income" hx-put="{{ route('incomes.update', [$income]) }}" />
  </x-modal>
@else
  <x-layouts.dashboard title="Edit income">
    <x-container>
      <div class="mb-5 lg:mb-10">
        <h1 class="text-3xl font-bold">Edit Income</h1>
      </div>

      <div>
        <x-edit-income-form :income="$income" />
      </div>
    </x-container>
  </x-layouts.dashboard>
@endif
