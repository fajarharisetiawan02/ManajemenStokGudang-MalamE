<div class="bg-white shadow px-8 py-4 flex justify-between items-center">

    <!-- TITLE -->
    <div>
        <h2 class="text-2xl font-bold text-slate-800">Dashboard</h2>
    </div>

    <!-- RIGHT SIDE -->
    <div class="flex items-center gap-4">

        <!-- NOTIFICATION -->
        <button class="relative bg-slate-100 px-3 py-2 rounded-xl hover:bg-slate-200 transition">
            <i class="fas fa-bell text-slate-700"></i>
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] px-1 rounded-full">
                3
            </span>
        </button>

<div class="relative">

    <!-- BUTTON -->
<button id="dropdownUserButton"
    data-dropdown-toggle="dropdownProfile"
    data-dropdown-placement="bottom-start"
    class="bg-blue-50 px-4 py-2 rounded-xl flex items-center gap-2 hover:bg-blue-100 transition">

        <i class="fas fa-user-circle text-blue-600 text-xl"></i>
        <span class="font-medium">Admin</span>
        <i class="fas fa-chevron-down text-sm text-gray-500"></i>
    </button>

    <!-- DROPDOWN -->
<div id="dropdownProfile"
    class="hidden z-50 w-56 bg-white rounded-xl shadow-lg border mt-2">
        <ul class="py-2 text-sm text-gray-700">

            <li>
                <a href="#" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100">
                    <i class="fas fa-user text-gray-500"></i> Profil
                </a>
            </li>

            <li>
                <a href="#" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100">
                    <i class="fas fa-cog text-gray-500"></i> Pengaturan
                </a>
            </li>

            <li>
                <a href="/ubah-password" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100">
                    <i class="fas fa-key text-yellow-500"></i> Ubah Kata Sandi
                </a>
            </li>

        </ul>

        <div class="py-2">
            <a href="/logout" class="flex items-center gap-2 px-4 py-2 text-red-500 hover:bg-red-50">
                <i class="fas fa-sign-out-alt"></i> Keluar
            </a>
        </div>

    </div>

</div>