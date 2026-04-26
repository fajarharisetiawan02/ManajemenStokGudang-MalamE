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

<!-- PROFILE DROPDOWN (FLOWBITE) -->
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

        <a href="/ubah-password" class="flex items-center gap-2 px-4 py-3 hover:bg-gray-100 transition">
            <i class="fas fa-key text-yellow-500"></i> Ubah Kata Sandi
        </a>

        <hr>

        <a href="/logout" class="flex items-center gap-2 px-4 py-3 text-red-500 hover:bg-red-50 transition">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>

    </div>

</div>

    </div>

</div>

<!-- SCRIPT -->
<script>
    function toggleDropdown() {
        document.getElementById("dropdownProfile").classList.toggle("hidden");
    }

    // Optional: klik luar untuk close
    window.addEventListener('click', function (e) {
        const dropdown = document.getElementById("dropdownProfile");
        if (!e.target.closest('.relative')) {
            dropdown.classList.add("hidden");
        }
    });
</script>