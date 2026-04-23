<div class="bg-white shadow px-8 py-4 flex justify-between items-center">

    <div>
        <h2 class="text-2xl font-bold text-slate-800">Dashboard</h2>
    </div>

    <div class="flex items-center gap-4">

        <!-- Search -->
        <div class="relative">
            <input type="text" placeholder="Cari barang..."
                class="pl-10 pr-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-blue-500">
            <i class="fas fa-search absolute left-3 top-3 text-slate-400"></i>
        </div>

        <!-- Notification -->
        <button class="relative bg-slate-100 px-3 py-2 rounded-xl hover:bg-slate-200 transition">
            <i class="fas fa-bell text-slate-700"></i>
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] px-1 rounded-full">
                3
            </span>
        </button>

        <!-- Profile -->
        <div class="bg-blue-50 px-4 py-2 rounded-xl flex items-center gap-2">
            <i class="fas fa-user-circle text-blue-600 text-xl"></i>
            <span class="font-medium">Admin</span>
        </div>

    </div>

</div>