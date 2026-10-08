<hx-partial hx-target="#expenses-list" hx-swap="beforeend">
  @foreach ($expenses->items() as $expense)
    <x-expense-list-item :expense="$expense" />
  @endforeach
</hx-partial>

@if ($expenses->hasMorePages())
  <hx-partial hx-target="#load-more" hx-swap="outerHTML">
    <div
      id="load-more"
      class="text-center py-4"
      hx-get="{{ $expenses->nextPageUrl() }}"
      hx-trigger="intersect"
    >
      <span class="htmx-indicator loading loading-dots loading-md text-primary"></span>
    </div>
  </hx-partial>
@else
  <hx-partial hx-target="#load-more" hx-swap="delete" />
@endif
