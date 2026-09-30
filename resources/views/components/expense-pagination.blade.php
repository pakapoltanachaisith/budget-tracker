@php
  $urls = $paginator->getUrlRange(1, $paginator->lastPage());
@endphp

@if ($paginator->hasPages())
  <nav role="navigation" class="join">
    {{-- Previous page --}}
    @if ($paginator->onFirstPage())
      <span class="join-item btn btn-sm btn-disabled">
        <span class="sr-only">Previous page</span>
        <i class="ti ti-chevron-left"></i>
      </span>
    @else
      <a href="{{ $paginator->previousPageUrl() }}" class="join-item btn btn-sm">
        <span class="sr-only">Previous page</span>
        <i class="ti ti-chevron-left"></i>
      </a>
    @endif

    @foreach ($urls as $url)
      <a href="{{ $url }}" @class([
          'join-item btn btn-sm',
          'btn-active' => $loop->iteration === $paginator->currentPage(),
      ])>{{ $loop->iteration }}</a>
    @endforeach

    {{-- Next page --}}
    @if ($paginator->onLastPage())
      <span class="join-item btn btn-sm btn-disabled">
        <span class="sr-only">Next page</span>
        <i class="ti ti-chevron-right"></i>
      </span>
    @else
      <a href="{{ $paginator->nextPageUrl() }}" class="join-item btn btn-sm">
        <span class="sr-only">Next page</span>
        <i class="ti ti-chevron-right"></i>
      </a>
    @endif
  </nav>
@endif
