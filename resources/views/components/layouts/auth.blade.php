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
  <div class="h-screen bg-base-200 flex items-center justify-center">
    <main class="bg-base-100 w-[90%] max-w-150 p-6 lg:p-8 rounded-box shadow-sm">{{ $slot }}</main>
  </div>
</body>

</html>
