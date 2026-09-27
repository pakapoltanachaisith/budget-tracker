<x-layouts.dashboard title="Home">
  <h1 class="text-3xl">Hello World</h1>
  <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button class="btn btn-error">Logout</button>
  </form>
</x-layouts.dashboard>
