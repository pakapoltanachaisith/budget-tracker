@props(['monthlyArray', 'activeMonth', 'activeCategories'])

<button
  type="button"
  class="btn btn-square btn-neutral btn-soft mr-2 lg:hidden"
  command="show-modal"
  commandfor="filter-expense-modal"
>
  <span class="sr-only">open filter modal</span>
  <i class="ti ti-filter"></i>
</button>

<dialog
  id="filter-expense-modal"
  class="modal"
  {{-- x-data
  x-init="$root.showModal()"
  @close="$root.remove()" --}}
>
  <div class="modal-box" @click.outside="$root.close()">
    <button
      type="button"
      class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
      commandfor="filter-expense-modal"
      command="close"
    >
      <span class="sr-only">close</span>
      <i class="ti ti-x"></i>
    </button>
    <h3 class="text-lg font-bold">Filters</h3>
    <x-expenses-filters
      :monthlyArray="$monthlyArray"
      :activeMonth="$activeMonth"
      :activeCategories="$activeCategories"
    />
  </div>
</dialog>
