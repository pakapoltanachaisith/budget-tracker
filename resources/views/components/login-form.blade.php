<form action="{{ route('login') }}" method="POST">
  @csrf
  <div class="space-y-4">
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
          autofocus
        >
      </div>
      @error('email')
        <span class="label text-error">{{ $message }}</span>
      @enderror
    </div>
    <div class="fieldset">
      <label for="password" class="fieldset-legend">Password</label>
      <x-password-input
        class="w-full"
        name="password"
        id="password"
        requited
      />
      @error('password')
        <span class="label text-error">{{ $message }}</span>
      @enderror
    </div>
    <div class="fieldset">
      <label class="fieldset-label">
        <input
          type="checkbox"
          class="checkbox"
          name="remember_me"
          value="true"
          @checked(old('remember_me'))
        >
        Remember me
      </label>
      @error('remember_me')
        <span class="fieldset-label text-error">{{ $message }}</span>
      @enderror
    </div>
  </div>
  <div class="mt-7">
    <button class="btn btn-primary w-full">
      Continue
      <i class="ti ti-chevron-right-filled text-primary-content"></i>
    </button>
  </div>
</form>
