<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GudangPro — Kelola Stok Gudang')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- PRELOAD HERO IMAGE -->
    <link rel="preload" as="image" href="{{ asset('images/gudang.png') }}">

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- VITE -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 font-sans text-gray-800">

    <!-- NAVBAR -->
    <x-landing-navbar />

    <!-- CONTENT -->
    @yield('content')

    <!-- FOOTER -->
    <x-landing-footer />

    @yield('script')

</body>

</html>