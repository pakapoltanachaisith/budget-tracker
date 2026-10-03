<form action="{{ route('register') }}" method="POST">
  @csrf
  <div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="fieldset">
        <label for="name" class="fieldset-legend">Name</label>
        <input
          id="name"
          name="name"
          type="text"
          class="input w-full"
          required
          autofocus
          value="{{ old('name') }}"
        >
        @error('name')
          <span class="label text-error">{{ $message }}</span>
        @enderror
      </div>
      <div class="fieldset">
        <label for="email" class="fieldset-legend">Email Address</label>
        <div class="input w-full">
          <i class="ti ti-mail text-gray-400"></i>
          <input
            type="email"
            class="grow"
            id="email"
            name="email"
            value="{{ old('email') }}"
            required
          >
        </div>
        @error('email')
          <span class="label text-error">{{ $message }}</span>
        @enderror
      </div>
    </div>

    <div class="fieldset">
      <label for="password" class="fieldset-legend">Password</label>
      <x-password-input
        name="password"
        id="password"
        class="input w-full"
        required
      />
      @error('password')
        <span class="label text-error">{{ $message }}</span>
      @enderror
    </div>
    <div class="fieldset">
      <label for="password_confirmation" class="fieldset-legend">Confirm Password</label>
      <x-password-input
        name="password_confirmation"
        id="password_confirmation"
        class="input w-full"
        required
      />
    </div>
  </div>
  <div class="mt-7">
    <button class="btn btn-primary w-full">
      Create Account
      <i class="ti ti-chevron-right-filled  text-primary-content"></i>
    </button>
  </div>
</form>
