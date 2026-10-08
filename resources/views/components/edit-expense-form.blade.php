@props(['expense'])

@php
  use App\Enums\ExpenseCategory;
  $categories = ExpenseCategory::cases();
@endphp

<form {{ $attributes->merge([
    'method' => 'POST',
    'action' => route('expenses.update', [$expense]),
]) }}>
  @method('PUT')
  @csrf
  <div class="space-y-3">
    <div class="fieldset">
      <label for="amount" class="fieldset-legend">Amount</label>
      <div class="input w-full">
        <i class="ti ti-currency-baht text-lg"></i>
        <input
          type="number"
          name="amount"
          id="amount"
          class="grow"
          step="0.01"
          required
          autofocus
          autocomplete="off"
          placeholder="300.00"
          value="{{ old('amount', $expense->amount) }}"
        >
      </div>
      @error('amount')
        <span class="label text-error">{{ $message }}</span>
      @enderror
    </div>
    <div class="fieldset">
      <label for="note" class="fieldset-legend">Note (optional)</label>
      <textarea
        name="note"
        id="note"
        class="textarea w-full"
      >{{ old('note', $expense?->note) }}</textarea>
      @error('note')
        <span class="label text-error">{{ $message }}</span>
      @enderror
    </div>
    <div class="fieldset">
      <label for="date" class="fieldset-legend">Date</label>
      <input
        name="date"
        id="date"
        type="date"
        class="input w-full"
        max="{{ today()->toDateString() }}"
        required
        value="{{ old('date', $expense->date) }}"
      >
      @error('date')
        <span class="label text-error">{{ $message }}</span>
      @enderror
    </div>
    <div class="fieldset">
      <label for="category" class="fieldset-legend">Category</label>
      <select
        name="category"
        id="category"
        class="select w-full"
        required
      >
        @foreach ($categories as $category)
          <option
            value="{{ $category->value }}"
            @selected(old('category', $expense->category) === $category)
            class="capitalize"
          >{{ $category->value }}</option>
        @endforeach
      </select>
      @error('category')
        <span class="fieldset-label text-error">{{ $message }}</span>
      @enderror
    </div>
  </div>

  <div class="mt-6">
    <button type="submit" class="btn btn-primary">Save Changes</button>
    <button type="reset" class="btn ml-2">Reset</button>
  </div>
</form>
