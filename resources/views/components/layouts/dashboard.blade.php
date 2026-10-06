@props(['title'])

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
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
      <main class="p-4 lg:p-10 flex-1 overflow-auto">{{ $slot }}</main>
    </div>

    <x-sidebar />
  </div>
  <div id="modal"></div>
</body>

</html>
