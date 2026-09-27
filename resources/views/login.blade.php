<x-layouts.auth title="Log in">
  <div class="space-y-6 lg:space-y-8">
    <h1 class="text-4xl font-bold text-center">Log In</h1>

    <form action="{{ route('login') }}" method="POST">
      @csrf
      <div class="space-y-4">
        <div class="fieldset">
          <label for="name" class="fieldset-legend">Email Address</label>
          <div class="input w-full">
            <i class="fa-regular fa-envelope text-gray-400"></i>
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
          <label for="passoword" class="fieldset-legend">Password</label>
          <input
            type="password"
            name="password"
            id="password"
            class="input w-full"
            required
          >
          @error('password')
            <span class="label text-error">{{ $message }}</span>
          @enderror
        </div>
      </div>
      <div class="mt-7">
        <button class="btn btn-primary w-full">
          Continue
          <i class="fa-solid fa-chevron-right text-primary-content"></i>
        </button>
      </div>
    </form>

    <div class="text-center text-sm text-gray-500">
      Don't have an account? <a href="{{ route('register') }}" class="text-primary ml-1.5">Register</a>
    </div>
  </div>
</x-layouts.auth>
