@extends('layouts.app')

@section('title', 'Supplier')

@section('content')

<div class="w-full space-y-4">

    <div class="w-full bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

        {{-- HEADER --}}
        <div class="px-5 py-4 border-b border-slate-200 bg-slate-50">

            <h3 class="text-lg font-semibold text-slate-800">
                Data Supplier
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                Daftar seluruh supplier yang terdaftar.
            </p>

        </div>

        {{-- FILTER --}}
        <form method="GET" action="{{ route('manager.supplier.index') }}">

            <div class="px-4 py-4 flex flex-wrap items-center gap-3">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari supplier..."
                    class="w-64 border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm transition">

                    <i class="fas fa-filter mr-1"></i>
                    Filter

                </button>

                <a
                    href="{{ route('manager.supplier.index') }}"
                    class="border border-slate-300 px-4 py-2 rounded-lg hover:bg-slate-50 transition">

                    Reset

                </a>

            </div>

        </form>

        {{-- SHOW ENTRIES --}}
        <div class="flex justify-between items-center px-4 py-3 border-b bg-white">

            <div class="flex items-center gap-2 text-sm">

                <span>Show</span>

                <select
                    onchange="window.location='?per_page='+this.value"
                    class="h-10 min-w-[75px] border border-slate-300 rounded-lg px-3 pr-8 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <option value="10" {{ request('per_page',10)==10 ? 'selected' : '' }}>
                        10
                    </option>

                    <option value="25" {{ request('per_page')==25 ? 'selected' : '' }}>
                        25
                    </option>

                    <option value="50" {{ request('per_page')==50 ? 'selected' : '' }}>
                        50
                    </option>

                </select>

                <span>entries</span>

            </div>

        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full text-sm border-collapse">

                <thead class="bg-slate-50 text-slate-700">

                    <tr>

                        <th class="px-3 py-3 text-left font-semibold border">
                            No
                        </th>

                        <th class="px-3 py-3 text-left font-semibold border">
                            Nama Supplier
                        </th>

                        <th class="px-3 py-3 text-left font-semibold border">
                            Telepon
                        </th>

                        <th class="px-3 py-3 text-left font-semibold border">
                            Email
                        </th>

                        <th class="px-3 py-3 text-left font-semibold border">
                            Alamat
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($suppliers as $item)

                    <tr class="border-b hover:bg-slate-50 transition">

                        <td class="px-3 py-4 border">
                            {{ $suppliers->firstItem() + $loop->index }}
                        </td>

                        <td class="px-3 py-4 border font-semibold">
                            {{ $item->nama_supplier }}
                        </td>

                        <td class="px-3 py-4 border">
                            <a href="tel:{{ $item->telepon }}"
                                class="text-blue-600 hover:underline">
                                {{ $item->telepon }}
                            </a>
                        </td>

                        <td class="px-3 py-4 border">
                            {{ $item->email ?? '-' }}
                        </td>

                        <td class="px-3 py-4 border">
                            {{ $item->alamat }}
                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5"
                            class="text-center py-10 border text-gray-500">

                            Belum ada data supplier

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- PAGINATION --}}
        <div class="flex justify-between items-center px-4 py-3 border-t bg-white">

            <div class="text-sm text-gray-600">
                Showing
                {{ $suppliers->firstItem() ?? 0 }}
                to
                {{ $suppliers->lastItem() ?? 0 }}
                of
                {{ $suppliers->total() }}
                entries
            </div>

            <div class="flex items-center gap-2">

                <a href="{{ $suppliers->previousPageUrl() }}"
                    class="border px-4 py-2 rounded text-gray-600 hover:bg-gray-50 {{ !$suppliers->onFirstPage() ? '' : 'pointer-events-none opacity-50' }}">
                    Previous
                </a>

                <span class="border px-4 py-2 rounded bg-gray-100 font-medium">
                    {{ $suppliers->currentPage() }}
                </span>

                <a href="{{ $suppliers->nextPageUrl() }}"
                    class="border px-4 py-2 rounded text-gray-600 hover:bg-gray-50 {{ $suppliers->hasMorePages() ? '' : 'pointer-events-none opacity-50' }}">
                    Next
                </a>

            </div>

        </div>

    </div>

</div>

@endsection