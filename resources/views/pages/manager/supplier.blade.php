@extends('layouts.app')

@section('title', 'Supplier')

@section('content')
@php
    $statusOptions = ['aktif' => 'Aktif', 'nonaktif' => 'Nonaktif'];
@endphp

<div class="w-full space-y-4">

    <div class="w-full bg-white border border-gray-200 rounded-2xl shadow-sm">
        <div class="p-4 flex flex-wrap items-center gap-3 w-full">
            <form method="GET" action="{{ url('/manager/supplier') }}" class="flex flex-wrap items-center gap-3 w-full xl:w-auto">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari supplier..."
                        class="pl-9 pr-4 py-2.5 w-64 border border-gray-300 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                <select
                    name="status"
                    class="px-4 py-2.5 border border-gray-300 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    <option value="">Semua Supplier</option>
                    @foreach($statusOptions as $value => $label)
                        <option value="{{ $value }}" {{ request('status') === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                    class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm flex items-center gap-2 transition">
                    <i class="fas fa-filter"></i> Filter
                </button>

                <a href="{{ url('/manager/supplier') }}"
                    class="px-4 py-2.5 border border-gray-300 rounded-xl text-sm text-gray-600 hover:bg-gray-50 transition">
                    Reset
                </a>
            </form>
        </div>
    </div>

    <div class="w-full bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto w-full">
            <table class="w-full min-w-[1100px] text-[15px]">
                <thead class="bg-blue-600 text-white text-[13px] uppercase tracking-wide">
                    <tr>
                        <th class="px-4 py-4 text-left font-semibold">No</th>
                        <th class="px-4 py-4 text-left font-semibold">Nama Supplier</th>
                        <th class="px-4 py-4 text-left font-semibold">Telepon</th>
                        <th class="px-4 py-4 text-left font-semibold">Alamat</th>
                        <th class="px-4 py-4 text-center font-semibold">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($suppliers as $item)
                        @php
                            $status = $item['status'] ?? 1;
                        @endphp

                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-4 text-gray-500 text-[15px]">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-4 py-4 font-semibold text-gray-800 text-[15px]">
                                {{ $item['nama'] }}
                            </td>

                            <td class="px-4 py-4 text-gray-600 text-[15px]">
                                <a href="tel:{{ $item['telepon'] }}" class="text-blue-600 hover:underline font-medium">
                                    {{ $item['telepon'] }}
                                </a>
                            </td>

                            <td class="px-4 py-4 text-gray-600 text-[15px]">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-map-marker-alt text-gray-400 text-xs"></i>
                                    <span>{{ $item['alamat'] }}</span>
                                </div>
                            </td>

                            <td class="px-4 py-4 text-center">
                                @if($status == 1)
                                    <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-red-50 text-red-700 border border-red-100">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-14">
                                <div class="flex flex-col items-center text-center text-gray-500">
                                    <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                        <i class="fas fa-truck text-2xl text-gray-400"></i>
                                    </div>

                                    <p class="font-medium text-gray-700 text-[15px]">
                                        Belum ada data supplier
                                    </p>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Data supplier akan tampil di sini.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex flex-wrap items-center justify-between gap-3 px-4 py-3 border-t border-gray-200 bg-white">
            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600">
                <div class="flex items-center gap-2">
                    <span>Page</span>
                    <button class="w-8 h-8 border border-gray-300 bg-gray-100 text-gray-500 hover:bg-gray-200 transition">
                        <i class="fas fa-chevron-left text-xs"></i>
                    </button>
                    <div class="w-12 h-8 border border-gray-300 flex items-center justify-center bg-white text-gray-700">
                        1
                    </div>
                    <button class="w-8 h-8 border border-gray-300 bg-gray-100 text-gray-500 hover:bg-gray-200 transition">
                        <i class="fas fa-chevron-right text-xs"></i>
                    </button>
                </div>

                <span>of 1</span>

                <div class="flex items-center gap-2">
                    <span>View</span>
                    <select class="h-9 w-[90px] px-3 pr-8 border border-gray-300 bg-white text-sm focus:outline-none rounded-md">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                    </select>
                    <span>records</span>
                </div>
            </div>

            <div class="text-sm text-gray-600">
                Found total {{ count($suppliers ?? []) }} records
            </div>
        </div>
    </div>
</div>
@endsection