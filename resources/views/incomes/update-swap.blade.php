<hx-partial hx-target="{{ "#income-list-item-$income->id" }}" hx-swap="outerHTML">
  <x-income-list-item :income="$income" />
</hx-partial>

<hx-partial hx-target="#edit-income-modal" hx-swap="delete" />
