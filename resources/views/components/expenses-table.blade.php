@props([
    'expenses' => [],
])

<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
  <table class="table table-auto">
    <!-- head -->
    <thead>
      <tr>
        <th></th>
        <th>Amount</th>
        <th>Note</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($expenses as $expense)
        <tr>
          <th>{{ $loop->index + 1 }}</th>
          <td>${{ $expense->amount / 100 }}</td>
          <td class="text-sm truncate">{{ $expense->note ? Str::limit($expense->note, 30, '...') : '-' }}</td>
          <td class="text-nowrap">{{ $expense->formatDisplayDate() }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
