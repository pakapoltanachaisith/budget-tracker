@props(['title'])

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css"
    integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  >
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title ? "$title | Budget Tracker" : 'Budget Tracker' }}</title>
</head>

<body hx-boost="true">
  <div
    x-data
    @keyup.escape.window="$refs.drawerToggle.checked = false"
    class="drawer lg:drawer-open h-screen overflow-hidden"
  >
    <input
      type="checkbox"
      id="dashboard-drawer"
      class="drawer-toggle"
      hidden
      x-ref="drawerToggle"
    >

    <div class="drawer-content bg-base-200 h-full overflow-auto flex flex-col">
      <x-navbar />
      <main class="p-5 lg:p-10 flex-1 overflow-auto">{{ $slot }}</main>
    </div>

    <x-sidebar />
  </div>
</body>

</html>
