@props(['id' => \Illuminate\Support\Str::uuid(), 'trigger' => null])

@if ($trigger && $trigger->isNotEmpty())
  <button
    {{ $trigger->attributes->merge([
        'type' => 'button',
        'commandfor' => $id,
        'command' => 'show-modal',
    ]) }}
  >
    {{ $trigger }}
  </button>
@endif

<dialog {{ $attributes->merge(['class' => 'modal']) }} id="{{ $id }}">
  <div class="modal-box">
    <button
      type="button"
      class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2"
      commandfor="{{ $id }}"
      command="close"
    >
      <span class="sr-only">close</span>
      <i class="ti ti-x"></i>
    </button>

    {{ $slot }}
  </div>
</dialog>
