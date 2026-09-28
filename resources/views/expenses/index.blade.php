<x-layouts.dashboard title="My Expenses">
  <h1>My Expenses</h1>
  <ul>
    @foreach ($expenses as $expense)
      <li>{{ "$expense->amount - $expense->note" }}</li>
    @endforeach
  </ul>
</x-layouts.dashboard>
