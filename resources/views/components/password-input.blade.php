<div class="input w-full pr-0 overflow-hidden" x-data="{ show: false }">
  <input :type="show ? 'text' : 'password'" {{ $attributes->merge(['class' => 'grow']) }}>
  <button
    type="button"
    class="btn btn-square btn-ghost join-item"
    x-on:click="show = !show"
  >
    <i class="text-gray-500" :class="show ? 'ti ti-eye-off' : 'ti ti-eye'"></i>
    <span class="sr-only" x-text="show ? 'hide passoword' : 'show password'"></span>
  </button>
</div>
