@extends('layouts.app')

@section('title','Kategori')

@section('content')

<div class="w-full space-y-4">

    <div class="bg-white border border-slate-200 rounded-xl shadow-sm mb-6">

        {{-- FILTER --}}
        <div class="px-4 py-4">

            <div class="flex flex-wrap items-center gap-3">

                <select id="filterKategori"
                    class="border border-slate-300 rounded-lg px-4 py-2 min-w-[250px] focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    <option value="">
                        Semua Kategori
                    </option>

                    @foreach($kategori as $k)

                    <option value="{{ $k->id }}">
                        {{ $k->nama_kategori }}
                    </option>

                    @endforeach

                </select>

                <button id="btnFilter" type="button"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm transition">

                    <i class="fas fa-filter mr-1"></i>
                    Filter

                </button>

                <button id="resetFilter" type="button"
                    class="border border-slate-300 px-4 py-2 rounded-lg hover:bg-slate-50 transition">

                    Reset

                </button>

            </div>

        </div>

        {{-- LIST KATEGORI --}}
        <div class="p-5">

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                @foreach($kategori as $item)

                <div class="card bg-white border border-slate-200 rounded-xl p-5 shadow-sm hover:shadow-lg transition"
                    data-id="{{ $item->id }}">

                    <div class="flex justify-between items-start mb-3">

                        <h2 class="text-xl font-bold text-slate-800">
                            {{ $item->nama_kategori }}
                        </h2>

                        <span
                            class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-xs font-semibold border border-slate-200">
                            {{ $item->barang_count }} barang
                        </span>

                    </div>

                    @if($item->foto)

                    <img src="{{ asset($item->foto) }}" class="w-full h-44 object-cover rounded-xl">

                    @else

                    <div class="w-full h-44 bg-slate-100 rounded-xl flex flex-col items-center justify-center">

                        <i class="fas fa-box-open text-5xl text-slate-400"></i>

                        <span class="text-sm text-slate-500 mt-3">
                            Belum ada gambar
                        </span>

                    </div>

                    @endif

                    <div class="mt-4">

                        <a href="{{ route('manager.data-barang.index',['kategori_id'=>$item->id]) }}"
                            class="h-10 flex items-center justify-center bg-slate-700 hover:bg-slate-800 text-white rounded-lg text-sm font-medium transition">

                            Lihat Barang

                        </a>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

    </div>

</div>

@endsection