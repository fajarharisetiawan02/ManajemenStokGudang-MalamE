<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GudangPro')</title>

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- VITE -->
    @if(!request()->is('login'))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @vite(['resources/css/app.css'])
    @endif

</head>

<body id="loginPage"
    class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-white text-gray-800 flex flex-col font-poppins">

    <!-- NAVBAR -->
    <x-auth-navbar />

    <!-- CONTENT -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <x-auth-footer />

    <!-- SCRIPT -->
    @yield('script')

</body>

</html>