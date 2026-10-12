@props(['monthlyArray', 'activeMonth'])

@php
  use Illuminate\Support\Carbon;
@endphp

<div class="bg-base-100 p-4 shadow rounded-box">
  <h3 class="text-neutral-500 text-sm font-medium mb-4">Filters</h3>
  <form
    action="{{ route('expenses.index') }}"
    method="GET"
    x-data
  >
    <div class="fieldset">
      <label for="month" class="fieldset-legend">Month</label>
      <select
        name="month"
        id="month"
        class="select select-sm"
        @change="$root.requestSubmit()"
      >
        @foreach ($monthlyArray as $month)
          <option value="{{ $month }}" @selected($activeMonth === $month)>{{ Carbon::parse($month)->format('M Y') }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="mt-4 space-x-2">
      <button type="submit" class="btn btn-sm btn-primary btn-soft">Apply Filter</button>
      <a href="{{ route('expenses.index') }}" class="btn btn-sm">Reset</a>
    </div>
  </form>
</div>
