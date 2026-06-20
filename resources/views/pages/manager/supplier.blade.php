@extends('layouts.app')

@section('title', 'Supplier')

@section('content')
<div class="w-full space-y-4">

    <!-- TABLE CARD -->
    <div class="w-full bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

        <form method="GET" action="{{ url('/manager/supplier') }}">
            <div class="px-4 pb-4 pt-4 flex flex-wrap items-center gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari supplier..."
                    class="w-64 border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                    placeholder:text-slate-400 placeholder:font-normal placeholder:text-sm">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm transition">
                    <i class="fas fa-filter mr-1"></i> Filter
                </button>
                <a href="{{ url('/manager/supplier') }}"
                    class="border border-slate-300 px-4 py-2 rounded-lg hover:bg-slate-50 transition">
                    Reset
                </a>
            </div>
        </form>

        <div class="flex justify-between items-center px-4 py-3 border-b bg-white">
            <div class="flex items-center gap-2 text-sm">
                <span>Tampilkan</span>
                <select onchange="window.location='?per_page='+this.value"
                    class="h-10 min-w-[75px] border border-slate-300 rounded-lg px-3 pr-8 text-sm bg-white
                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="10" {{ request('per_page',10)==10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page')==25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page')==50 ? 'selected' : '' }}>50</option>
                </select>
                <span>data</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-slate-100 text-slate-800">
                    <tr>
                        <th class="px-4 py-4 text-center text-sm font-bold border w-16">No</th>
                        <th class="px-4 py-4 text-left text-sm font-bold border">Nama Supplier</th>
                        <th class="px-4 py-4 text-left text-sm font-bold border">Telepon</th>
                        <th class="px-4 py-4 text-left text-sm font-bold border">Email</th>
                        <th class="px-4 py-4 text-left text-sm font-bold border">Alamat</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($suppliers as $item)
                    <tr class="hover:bg-slate-50 transition-colors duration-150">
                        <td class="px-4 py-4 border text-center">{{ $suppliers->firstItem() + $loop->index }}</td>
                        <td class="px-4 py-4 border font-medium text-slate-800">{{ $item->nama_supplier }}</td>
                        <td class="px-4 py-4 border text-slate-700">{{ $item->telepon }}</td>
                        <td class="px-4 py-4 border text-slate-700">{{ $item->email ?? '-' }}</td>
                        <td class="px-4 py-4 border text-slate-700">{{ $item->alamat }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-10 text-center text-gray-500">Belum ada data supplier</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 px-5 py-4 border-t bg-slate-50">
            <div class="text-sm text-slate-600">
                Menampilkan
                <span class="font-semibold text-slate-800">{{ $suppliers->firstItem() ?? 0 }}</span>
                -
                <span class="font-semibold text-slate-800">{{ $suppliers->lastItem() ?? 0 }}</span>
                dari
                <span class="font-semibold text-blue-600">{{ $suppliers->total() }}</span>
                data supplier
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ $suppliers->previousPageUrl() }}"
                    class="flex items-center h-8 px-4 rounded-lg border border-slate-200 bg-white
                    text-slate-600 hover:bg-slate-100 text-sm transition
                    {{ $suppliers->onFirstPage() ? 'pointer-events-none opacity-50' : '' }}">
                    Sebelumnya
                </a>
                <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-600 text-white font-semibold text-xs">
                    {{ $suppliers->currentPage() }}
                </span>
                <a href="{{ $suppliers->nextPageUrl() }}"
                    class="flex items-center h-8 px-4 rounded-lg border border-slate-200 bg-white
                    text-slate-600 hover:bg-slate-100 text-sm transition
                    {{ !$suppliers->hasMorePages() ? 'pointer-events-none opacity-50' : '' }}">
                    Berikutnya
                </a>
            </div>
        </div>

    </div>

</div>
@endsection