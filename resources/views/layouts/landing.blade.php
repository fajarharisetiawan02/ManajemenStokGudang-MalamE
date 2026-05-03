<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GudangPro')</title>

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

    <!-- SCRIPT -->
    @yield('script')

</body>

</html>