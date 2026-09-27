<x-layouts.auth title="Log in">
  <div class="space-y-6 lg:space-y-8">
    <h1 class="text-4xl font-bold text-center">Log In</h1>

    <x-login-form />

    <div class="text-center text-sm text-gray-500">
      Don't have an account? <a href="{{ route('register') }}" class="text-primary ml-1.5">Register</a>
    </div>
  </div>
</x-layouts.auth>
