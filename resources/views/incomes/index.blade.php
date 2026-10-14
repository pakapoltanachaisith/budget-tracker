<x-layouts.dashboard title="My Incomes">
  <x-container>
    {{-- Header --}}
    <div class="mb-5 lg:mb-10 flex items-baseline">
      <div class="grow">
        <h1 class="text-3xl font-bold">My Incomes</h1>
        <p class="text-sm font-thin mt-2">{{ $incomeCount }} {{ Str::plural('income entry', $incomeCount) }}</p>
      </div>
      <div>
        <x-income-filter-modal
          :monthlyArray="$monthlyArray"
          :activeMonth="$activeMonth"
          :activeCategories="$activeCategories"
          :searchTerm="$searchTerm"
        />
        <a
          href="#"
          class="btn btn-neutral"
          hx-get="#"
          hx-target="#modal"
        >
          Add
          <i class="ti ti-plus"></i>
        </a>
      </div>
    </div>

    {{-- Income List and Filters --}}
    <div class="grid grid-cols-3 gap-5">
      <div class="col-span-3 lg:col-span-2">
        <ul id="incomes-list" class="space-y-4">
          @fragment('list-items')
            @foreach ($incomes as $income)
              @if ($incomes->hasMorePages() && $incomes->count() === $loop->iteration)
                <x-income-list-item :income="$income" />
              @else
                <x-income-list-item :income="$income" />
              @endif
            @endforeach
          @endfragment
        </ul>
      </div>

      <div class="hidden lg:block self-start bg-base-100 p-4 shadow rounded-box">
        <h3 class="text-neutral-500 text-xs font-medium">Filters</h3>
        <x-incomes-filters
          :monthlyArray="$monthlyArray"
          :activeMonth="$activeMonth"
          :activeCategories="$activeCategories"
          :searchTerm="$searchTerm"
        />
      </div>
    </div>
  </x-container>
</x-layouts.dashboard>
