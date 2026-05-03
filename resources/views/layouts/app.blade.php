<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- TITLE -->
    <title>@yield('title', 'GudangPro')</title>

    <!-- VITE -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body class="bg-slate-100 font-sans">

    <div class="flex">

        <!-- SIDEBAR -->
        <x-sidebar />

        <!-- CONTENT -->
        <div class="ml-72 w-full flex flex-col min-h-screen">

            <!-- NAVBAR -->
            <x-navbar />

            <!-- CONTENT -->
            <div class="p-8 pt-24 flex-1">                
                @yield('content')
            </div>

            <!-- FOOTER -->
            <x-footer />

        </div>

    </div>

    <!-- SCRIPT KHUSUS HALAMAN -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>

    @yield('script')

</body>
</html>