@props(['expenses' => []])

<ul class="space-y-4">
  @foreach ($expenses as $expense)
    <li
      class="px-4 lg:px-6 py-4 bg-base-100 rounded-lg flex h-20 border border-transparent hover:border-primary hover:-translate-y-1 hover:scale-102 transition-all"
    >
      {{-- Icon --}}
      <div class="bg-orange-200/50 flex items-center justify-center h-full aspect-square rounded-lg shrink-0">
        <i class="ti ti-soup text-orange-900 text-2xl font-light"></i>
      </div>
      {{-- Category & Note --}}
      <div class="ml-4 flex flex-col grow pr-5 truncate justify-between max-w-[70%]">
        <span class="text-lg">Food</span>
        @if ($expense?->note)
          <span class="text-sm text-neutral-500 font-thin truncate">{{ $expense->note }}</span>
        @endif
      </div>
      {{-- Amount & Date --}}
      <div class="ml-auto flex flex-col shrink-0 items-end justify-between">
        <span class="text-sm text-neutral-700 font-mono">-${{ $expense->amount / 100 }}</span>
        <time datetime="{{ $expense->date }}" class="text-xs text-neutral-500">{{ $expense->formatDisplayDate() }}</time>
      </div>
    </li>
  @endforeach
</ul>
