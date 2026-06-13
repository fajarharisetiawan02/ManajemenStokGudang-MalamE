@php
$user = auth()->user();

$stokMenipis = \App\Models\Barang::with('kategori')
    ->where('stok', '<=', 10)
    ->orderBy('stok')
    ->limit(5)
    ->get();

$readIds = $user
    ? \App\Models\NotifikasiRead::where('user_id', $user->id)->pluck('barang_id')->toArray()
    : [];

$notifCount = $stokMenipis->whereNotIn('id', $readIds)->count();

if ($user && $notifCount > 0) {
    foreach ($stokMenipis->whereNotIn('id', $readIds) as $barang) {
        \App\Models\NotifikasiRead::updateOrCreate(
            ['user_id' => $user->id, 'barang_id' => $barang->id],
            ['read_at' => now()]
        );
    }
}
@endphp

<div class="bg-white shadow px-4 md:px-8 py-4 flex justify-between items-center
    fixed top-0 left-0 md:left-72 right-0 z-40">

    <!-- LEFT -->
    <div class="flex items-center gap-3">
        <button onclick="toggleSidebar()" class="md:hidden text-xl text-slate-700">
            <i class="fas fa-bars"></i>
        </button>
        <h2 class="text-xl md:text-2xl font-bold text-slate-800 truncate">
            @yield('title', 'Dashboard')
        </h2>
    </div>

    <!-- RIGHT -->
    <div class="flex items-center gap-2 md:gap-4">

        {{-- NOTIFIKASI --}}
        <div class="relative" id="notifWrapper">
            <button onclick="toggleNotif()"
                class="relative bg-slate-100 px-2 md:px-3 py-2 rounded-xl hover:bg-slate-200 transition">
                <i class="fas fa-bell text-slate-700"></i>
                @if($notifCount > 0)
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px]
                    min-w-[18px] h-[18px] flex items-center justify-center rounded-full font-semibold">
                    {{ $notifCount > 99 ? '99+' : $notifCount }}
                </span>
                @endif
            </button>

            <div id="dropdownNotif"
                class="hidden absolute right-0 mt-2 w-[340px] bg-white rounded-xl shadow-lg
                border border-slate-100 z-50 overflow-hidden">

                <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-bell text-slate-700 text-sm"></i>
                        <p class="text-sm font-semibold text-slate-800">{{ __('app.notifikasi') }}</p>
                    </div>
                    @if($stokMenipis->count() > 0)
                    <span class="text-[11px] font-semibold bg-red-50 text-red-700 px-2 py-0.5 rounded-full">
                        {{ $stokMenipis->count() }} {{ __('app.stok_menipis') }}
                    </span>
                    @endif
                </div>

                @if($stokMenipis->count() > 0)
                <div class="divide-y divide-slate-50 max-h-64 overflow-y-auto py-1">
                    @foreach($stokMenipis as $barang)
                    <a href="{{ route('admin.data-barang.show', $barang->id) }}"
                        class="flex items-start gap-3 px-4 py-3 hover:bg-slate-50 transition">

                        @if($barang->stok <= 0)
                        <div class="w-[34px] h-[34px] rounded-lg bg-red-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-exclamation-triangle text-red-600 text-xs"></i>
                        </div>
                        @elseif($barang->stok <= 5)
                        <div class="w-[34px] h-[34px] rounded-lg bg-orange-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-exclamation-circle text-orange-500 text-xs"></i>
                        </div>
                        @else
                        <div class="w-[34px] h-[34px] rounded-lg bg-yellow-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fas fa-box text-yellow-500 text-xs"></i>
                        </div>
                        @endif

                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2">
                                <p class="text-xs font-semibold text-slate-700 truncate">{{ $barang->nama_barang }}</p>
                                @if($barang->stok <= 0)
                                <span class="text-[10px] font-semibold bg-red-50 text-red-700 px-1.5 py-0.5 rounded flex-shrink-0">{{ __('app.habis') }}</span>
                                @elseif($barang->stok <= 5)
                                <span class="text-[10px] font-semibold bg-orange-50 text-orange-700 px-1.5 py-0.5 rounded flex-shrink-0">{{ __('app.kritis') }}</span>
                                @else
                                <span class="text-[10px] font-semibold bg-yellow-50 text-yellow-700 px-1.5 py-0.5 rounded flex-shrink-0">{{ __('app.menipis') }}</span>
                                @endif
                            </div>
                            <p class="text-xs text-slate-400 mt-0.5">
                                {{ __('app.stok_tersisa') }}:
                                <span class="font-semibold {{ $barang->stok <= 0 ? 'text-red-600' : ($barang->stok <= 5 ? 'text-orange-500' : 'text-yellow-600') }}">
                                    {{ $barang->stok }} unit
                                </span>
                            </p>
                        </div>
                    </a>
                    @endforeach
                </div>

                <div class="px-4 py-2.5 border-t border-slate-100 bg-slate-50">
                    <a href="{{ route('admin.data-barang.index') }}?stok=menipis"
                        class="text-xs font-semibold text-blue-600 hover:text-blue-700 flex items-center justify-center gap-1.5">
                        {{ __('app.lihat_semua_produk') }} <i class="fas fa-arrow-right text-[10px]"></i>
                    </a>
                </div>

                @else
                <div class="px-4 py-8 text-center">
                    <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-check text-green-500 text-sm"></i>
                    </div>
                    <p class="text-xs font-semibold text-slate-700">{{ __('app.semua_stok_aman') }}</p>
                    <p class="text-xs text-slate-400 mt-1">{{ __('app.tidak_ada_barang') }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- DROPDOWN USER --}}
        <div class="relative" id="userDropdownWrapper">
            <button onclick="toggleDropdown()"
                class="flex items-center gap-2 px-2 py-2 rounded-xl hover:bg-slate-100 transition">

                @php
                    $initials = collect(explode(' ', $user?->name ?? 'U'))->map(fn($w) => strtoupper($w[0]))->take(2)->join('');
                @endphp
                <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center flex-shrink-0">
                    <span class="text-white text-xs font-bold">{{ $initials }}</span>
                </div>

                <div class="hidden md:block text-left">
                    <p class="font-semibold text-sm text-slate-800 leading-tight">{{ $user?->name ?? 'Pengguna' }}</p>
                    <p class="text-xs text-slate-400 capitalize leading-tight">{{ $user?->role ?? 'admin' }}</p>
                </div>

                <i id="dropdownChevron" class="fas fa-chevron-down text-xs text-gray-400 transition-transform duration-200"></i>
            </button>

            <div id="dropdownProfile"
                class="hidden absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-lg border border-slate-100 z-50 overflow-hidden">

                <div class="px-4 py-3 border-b border-slate-100 bg-slate-50">
                    <p class="text-sm font-semibold text-slate-800 truncate">{{ $user?->name ?? 'Pengguna' }}</p>
                    <p class="text-xs text-slate-400 capitalize">{{ $user?->role ?? 'admin' }}</p>
                </div>

                <a href="{{ route('profile.index') }}"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition">
                    <i class="fas fa-user text-slate-400 w-4"></i> {{ __('app.profil') }}
                </a>

                <a href="{{ route('profile.index') }}#password"
                    class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 transition">
                    <i class="fas fa-key text-yellow-500 w-4"></i> {{ __('app.ubah_kata_sandi') }}
                </a>

                <div class="border-t border-slate-100">
                    <button type="button" onclick="confirmLogout()"
                        class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition text-left">
                        <i class="fas fa-sign-out-alt w-4"></i> {{ __('app.keluar') }}
                    </button>
                </div>

            </div>
        </div>

    </div>
</div>