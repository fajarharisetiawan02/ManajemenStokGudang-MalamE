<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'GudangPro — Kelola Stok Gudang')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        #mainContent { padding-top: 100px; }
        @media (min-width: 768px) { #mainContent { padding-top: 96px; } }
    </style>
</head>

<body class="bg-slate-100 font-sans">

    {{-- DATA UNTUK layout.js --}}
    <div id="appData" class="hidden"
        data-locale="{{ app()->getLocale() }}"
        data-success="{{ session('success') }}"
        data-error="{{ session('error') }}"
        data-warning="{{ session('warning') }}">
    </div>

    <div class="flex min-h-screen">
        <x-sidebar />
        <div id="overlay" onclick="toggleSidebar()"
            class="fixed inset-0 bg-black/40 hidden z-40 md:hidden">
        </div>
        <div class="md:ml-72 w-full flex flex-col min-h-screen">
            <x-navbar />
            <div id="mainContent" class="p-4 md:p-8 flex-1">
                @yield('content')
            </div>
            <x-footer />
        </div>
    </div>

    <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('script')
    @stack('scripts')

</body>

</html>