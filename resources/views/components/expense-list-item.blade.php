@props(['expense'])

<li id="{{ "expense-list-item-$expense->id" }}"
  class="expense-list-item py-4 bg-base-100 rounded-lg  border-transparent hover:border-primary hover:-translate-y-1 hover:scale-102 transition-all"
>
  <div class="px-4 lg:px-6 flex h-12">
    {{-- Icon --}}
    <x-expense-icon :category="$expense->category" />
    {{-- Category & Note --}}
    <div class="ml-4 flex flex-col justify-between grow pr-5 truncate max-w-[70%]">
      <span class="text-lg capitalize">{{ $expense->category }}</span>
      @if ($expense?->note)
        <span class="text-sm text-neutral-500 font-thin truncate">{{ $expense->note }}</span>
      @endif
    </div>
    {{-- Amount & Date --}}
    <div class="ml-auto flex flex-col justify-between shrink-0 items-end">
      <span class="text-sm text-neutral-700 font-mono">-${{ $expense->amount / 100 }}</span>
      <time datetime="{{ $expense->date }}"
        class="text-xs text-neutral-500 mt-1">{{ $expense->formatDisplayDate() }}</time>
    </div>
  </div>

  <div class="divider my-2 opacity-50"></div>
  <div class="px-4 lg:px-6 text-right">
    <div class="join">
      <a
        href="{{ route('expenses.edit', [$expense]) }}"
        class="btn btn-sm"
        hx-get="{{ route('expenses.edit', [$expense]) }}"
        hx-target="#modal"
        hx-swap="innerHTML"
      >
        <i class="ti ti-edit"></i>
        Edit
      </a>
      <form
        action="{{ route('expenses.destroy', [$expense]) }}"
        method="POST"
        hx-delete="{{ route('expenses.destroy', [$expense]) }}"
        hx-target="closest li"
        hx-swap="outerHTML"
        hx-confirm="Do you wish to delete this expense?"
      >
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-error btn-soft btn-square">
          <span class="sr-only">Delete</span>
          <i class="ti ti-trash"></i>
        </button>
      </form>
    </div>
  </div>
</li>
