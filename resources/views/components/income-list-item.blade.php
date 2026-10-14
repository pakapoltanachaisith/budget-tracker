@props(['income'])

<li
  {{ $attributes->merge() }}
  id="{{ "income-list-item-$income->id" }}"
  class="income-list-item py-4 bg-base-100 rounded-lg  border-transparent hover:border-primary hover:-translate-y-1 hover:scale-102 transition-all"
>
  <div class="px-4 lg:px-6 flex h-12">
    {{-- Icon --}}
    <x-income-icon :category="$income->category" />
    {{-- Category & Note --}}
    <div class="ml-4 flex flex-col justify-between grow pr-5 truncate max-w-[70%]">
      <span class="text-lg capitalize">{{ $income->category }}</span>
      @if ($income?->note)
        <span class="text-sm text-neutral-500 font-thin truncate">{{ $income->note }}</span>
      @endif
    </div>
    {{-- Amount & Date --}}
    <div class="ml-auto flex flex-col justify-between shrink-0 items-end">
      <span class="text-sm text-neutral-700 font-mono">+${{ $income->amount / 100 }}</span>
      <time datetime="{{ $income->date }}" class="text-xs text-neutral-500 mt-1">{{ $income->formatDisplayDate() }}</time>
    </div>
  </div>

  <div class="divider my-2 opacity-50"></div>

  <div class="px-4 lg:px-6 text-right">
    <div class="join">
      <a
        href="#"
        class="btn btn-sm"
        hx-get="#"
        hx-target="#modal"
        hx-swap="innerHTML"
      >
        <i class="ti ti-edit"></i>
        Edit
      </a>
      <form
        action="#"
        method="POST"
        hx-delete="#"
        hx-target="closest li"
        hx-swap="outerHTML"
        hx-confirm="Do you wish to delete this income?"
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
