<div class="bg-white shadow px-8 py-4 flex justify-between items-center
    fixed top-0 left-72 right-0 z-50">
    
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

        <!-- PROFILE -->
        <div class="relative">

            <!-- BUTTON (tidak berubah tampilan) -->
            <button id="dropdownUserButton"
                data-dropdown-toggle="dropdownProfile"
                data-dropdown-placement="bottom-end"
                class="bg-blue-50 px-4 py-2 rounded-xl flex items-center gap-2 hover:bg-blue-100 transition">

                <i class="fas fa-user-circle text-blue-600 text-xl"></i>
                <span class="font-medium">Admin</span>
                <i class="fas fa-chevron-down text-sm text-gray-500"></i>
            </button>

            <!-- DROPDOWN -->
            <div id="dropdownProfile"
                class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border z-50">

                <a href="#" class="flex items-center gap-2 px-4 py-3 hover:bg-gray-100">
                    <i class="fas fa-user text-gray-500"></i> Profil
                </a>

                <a href="#" class="flex items-center gap-2 px-4 py-3 hover:bg-gray-100">
                    <i class="fas fa-cog text-gray-500"></i> Pengaturan
                </a>

                <a href="/ubah-password"
                    class="flex items-center gap-2 px-4 py-3 hover:bg-gray-100">
                    <i class="fas fa-key text-yellow-500"></i> Ubah Kata Sandi
                </a>

                <hr>

                <a href="/logout"
                    class="flex items-center gap-2 px-4 py-3 text-red-500 hover:bg-red-50">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>

            </div>

        </div>

    </div>
</div>