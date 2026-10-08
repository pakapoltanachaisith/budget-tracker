<hx-partial hx-target="{{ "#expense-list-item-$expense->id" }}" hx-swap="outerHTML">
  <x-expense-list-item :expense="$expense" />
</hx-partial>

<hx-partial hx-target="#edit-expense-modal" hx-swap="delete" />
