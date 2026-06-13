@extends('layouts.app')

@section('title', 'Kategori')

@section('content')

    <div class="w-full space-y-4">

        <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

            {{-- FILTER --}}
            <div class="p-4 space-y-3">
                <div class="flex flex-wrap items-center gap-3">
                    <select id="filterKategori"
                        class="border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategori as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                    <button id="btnFilter" type="button"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm transition">
                        <i class="fas fa-filter mr-1"></i> Filter
                    </button>
                    <button id="resetFilter" type="button"
                        class="border border-slate-300 px-4 py-2 rounded-lg hover:bg-slate-50 transition">
                        Reset
                    </button>
                </div>
            </div>

            {{-- GRID KATEGORI --}}
            <div class="p-5">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

                    @foreach ($kategori as $item)
                        <div class="card bg-white border border-slate-200 rounded-xl shadow-sm
                            hover:shadow-md transition-all duration-200"
                            data-id="{{ $item->id }}">

                            {{-- IMAGE --}}
                            <div class="relative">
                                @if ($item->foto)
                                    <img src="{{ asset($item->foto) }}" class="w-full h-36 object-cover rounded-t-xl">
                                @else
                                    <div class="w-full h-36 bg-slate-100 rounded-t-xl
                                        flex flex-col items-center justify-center gap-1">
                                        <i class="fas fa-box-open text-4xl text-slate-300"></i>
                                        <span class="text-xs text-slate-400">Belum ada gambar</span>
                                    </div>
                                @endif

                                {{-- BADGE JUMLAH --}}
                                <span class="absolute top-2.5 right-2.5 bg-white/90 text-slate-600
                                    px-2.5 py-1 rounded-full text-xs font-semibold border border-slate-200 shadow-sm">
                                    {{ $item->barang_count }} barang
                                </span>
                            </div>

                            {{-- BODY --}}
                            <div class="px-4 py-3 flex items-center justify-between">
                                <h2 class="font-bold text-slate-800 text-sm">
                                    {{ $item->nama_kategori }}
                                </h2>
                                <div class="flex items-center gap-1.5">
                                    <a href="{{ route('manager.data-barang.index', ['kategori_id' => $item->id]) }}"
                                        class="px-3 py-2 bg-slate-700 hover:bg-slate-800 text-white rounded-lg shadow-sm transition text-sm">
                                        <i class="fas fa-boxes text-xs"></i> Barang
                                    </a>
                                </div>
                            </div>

                        </div>
                    @endforeach

                    @if ($kategori->isEmpty())
                        <div class="col-span-3 py-16 text-center text-slate-400">
                            <i class="fas fa-layer-group text-4xl mb-3 block text-slate-300"></i>
                            Belum ada kategori
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>

@endsection
