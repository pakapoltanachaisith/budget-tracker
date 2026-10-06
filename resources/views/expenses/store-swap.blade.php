<hx-partial hx-target="#expenses-list" hx-swap="afterbegin">
  <x-expense-list-item :expense="$expense" />
</hx-partial>

<hx-partial hx-target="#create-expense-modal" hx-swap="delete" />
