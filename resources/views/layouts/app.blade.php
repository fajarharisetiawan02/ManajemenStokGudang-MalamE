<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'GudangPro')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body class="bg-slate-100 font-sans">

    {{-- DATA UNTUK layout.js --}}
    <div id="appData" class="hidden"
        data-locale="{{ app()->getLocale() }}"
        data-success="{{ session('success') }}"
        data-error="{{ session('error') }}"
        data-warning="{{ session('warning') }}">
    </div>

    <div class="flex">

        <!-- SIDEBAR -->
        <x-sidebar />

        <!-- OVERLAY (MOBILE) -->
        <div id="overlay" onclick="toggleSidebar()"
            class="fixed inset-0 bg-black/40 hidden z-40 md:hidden">
        </div>

        <!-- CONTENT -->
        <div class="md:ml-72 w-full flex flex-col min-h-screen">

            <!-- NAVBAR -->
            <x-navbar />

            <!-- MAIN CONTENT -->
            <div class="p-4 md:p-8 pt-20 md:pt-24 flex-1">
                @yield('content')
            </div>

            <!-- FOOTER -->
            <x-footer />

        </div>

    </div>

    <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('script')
    @stack('scripts')

</body>

</html>