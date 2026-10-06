@props(['expenses' => []])

<ul id="expenses-list" class="space-y-4">
  @foreach ($expenses as $expense)
    <x-expense-list-item :expense="$expense" />
  @endforeach
</ul>
