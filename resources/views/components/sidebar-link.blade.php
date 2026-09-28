@props(['href', 'label', 'icon', 'active' => false])

<li>
  <a href="{{ $href }}" @class([
      'menu-active' => $active,
  ])>
    @if ($icon)
      <i class="{{ $icon }}"></i>
    @endif
    {{ $label }}
  </a>
</li>
