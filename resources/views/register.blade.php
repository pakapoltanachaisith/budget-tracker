<x-layouts.auth title="Register">
  <div class="space-y-6 lg:space-y-8">
    <h1 class="text-4xl font-bold text-center">Register</h1>

    <x-register-form />

    <div class="text-center text-sm text-gray-500">
      Already have an account? <a href="{{ route('login') }}" class="text-primary ml-1.5">Log in</a>
    </div>
  </div>
</x-layouts.auth>
