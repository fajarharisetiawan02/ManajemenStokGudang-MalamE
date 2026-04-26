<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- TITLE -->
    <title>@yield('title', 'GudangPro')</title>

    <!-- VITE (GANTI CDN) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>


<body class="bg-slate-100 font-sans">

    <div class="flex">

        <!-- SIDEBAR -->
        @include('components.sidebar')

        <!-- CONTENT -->
        <div class="ml-72 w-full flex flex-col min-h-screen">

            <!-- NAVBAR -->
            <div class="bg-white shadow px-8 py-4 flex justify-between items-center">

                <!-- TITLE -->
                <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
                    @yield('icon')
                    @yield('title', 'Dashboard')
                </h2>

                <!-- RIGHT -->
                <div class="flex items-center gap-4">

                    <!-- NOTIF -->
                    <button class="relative bg-slate-100 px-3 py-2 rounded-xl hover:bg-slate-200 transition">
                        <i class="fas fa-bell text-slate-700"></i>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] px-1 rounded-full">
                            3
                        </span>
                    </button>

                    <!-- PROFILE DROPDOWN -->
                    <div class="relative">

                        <!-- BUTTON -->
                        <button id="dropdownUserButton" data-dropdown-toggle="dropdownProfile"
                            class="bg-blue-50 px-4 py-2 rounded-xl flex items-center gap-2 hover:bg-blue-100 transition">

                            <i class="fas fa-user-circle text-blue-600 text-xl"></i>
                            <span class="font-medium">Admin</span>
                            <i class="fas fa-chevron-down text-sm text-gray-500"></i>
                        </button>

                        <!-- DROPDOWN -->
                        <div id="dropdownProfile"
                            class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border z-50">

                            <a href="#" class="flex items-center gap-2 px-4 py-3 hover:bg-gray-100 transition">
                                <i class="fas fa-user text-gray-500"></i> Profil
                            </a>

                            <a href="#" class="flex items-center gap-2 px-4 py-3 hover:bg-gray-100 transition">
                                <i class="fas fa-cog text-gray-500"></i> Pengaturan
                            </a>

                            <a href="/ubah-password"
                                class="flex items-center gap-2 px-4 py-3 hover:bg-gray-100 transition">
                                <i class="fas fa-key text-yellow-500"></i> Ubah Kata Sandi
                            </a>

                            <hr>

                            <a href="/logout"
                                class="flex items-center gap-2 px-4 py-3 text-red-500 hover:bg-red-50 transition">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>

                        </div>

                    </div>

                </div>
            </div>

            <!-- CONTENT -->
            <div class="p-8 flex-1">
                @yield('content')
            </div>

            <!-- FOOTER -->
            <footer class="bg-white border-t px-6 py-4 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-4 border">
                        <div class="h-1/2 bg-red-600"></div>
                        <div class="h-1/2 bg-white"></div>
                    </div>
                    <span class="text-sm text-gray-600">Indonesia</span>
                </div>

                <p class="text-sm text-gray-500">
                    © 2026 <span class="font-semibold text-gray-700">GudangPro</span>
                </p>
            </footer>

        </div>

    </div>

    <!-- SCRIPT KHUSUS HALAMAN -->
    @yield('script')

</body>

</html>