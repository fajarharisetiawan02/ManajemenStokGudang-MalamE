@extends('layouts.app')

@section('title', 'Data Barang')

@section('content')

<div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

    <!-- ACTION -->
    <div class="p-4 border-b border-slate-200 bg-white">
        <a href="{{ route('admin.data-barang.index') }}"
            class="inline-flex items-center px-4 py-2 border border-slate-300 rounded-lg hover:bg-slate-50 transition">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
    </div>

    <!-- TITLE -->
    <div class="px-6 pt-6">
        <h2 class="text-2xl font-bold text-slate-800">Detail Barang</h2>
        <p class="text-sm text-slate-500 mt-1">Informasi lengkap barang yang tersimpan di sistem.</p>
    </div>

    <!-- CONTENT -->
    <div class="p-6">
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 items-start">

            <!-- GAMBAR -->
            <div class="flex flex-col h-full">
                @php $gambarUtama = $barang->gambarBarang->first(); @endphp

                <div class="bg-slate-50 border border-slate-200 rounded-xl overflow-hidden flex-1 flex items-center justify-center">
                    @if($gambarUtama)
                        <img id="mainImage" src="{{ asset('uploads/barang/' . $gambarUtama->gambar) }}"
                            alt="{{ $barang->nama_barang }}" class="w-full h-full object-contain p-4" style="min-height: 300px;">
                    @else
                        <div class="py-24 flex items-center justify-center text-slate-400 w-full">
                            <div class="text-center">
                                <i class="fas fa-image text-5xl mb-3"></i>
                                <p>Tidak ada gambar</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Thumbnail -->
                <div class="grid grid-cols-4 gap-3 mt-4">
                    @foreach($barang->gambarBarang->take(4) as $index => $gambar)
                        <button type="button" onclick="changeImage(this)"
                            data-image="{{ asset('uploads/barang/' . $gambar->gambar) }}"
                            class="thumb-btn overflow-hidden rounded-xl border {{ $index == 0 ? 'border-blue-500 border-2' : 'border-slate-200' }} hover:border-blue-400 transition">
                            <img src="{{ asset('uploads/barang/' . $gambar->gambar) }}" class="w-full h-20 object-cover">
                        </button>
                    @endforeach

                    @for($i = $barang->gambarBarang->count(); $i < 4; $i++)
                        <div class="h-20 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-center">
                            <i class="fas fa-image text-slate-300 text-xl"></i>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- DETAIL -->
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-6">
                <table class="w-full">
                    <tbody>

                        <tr class="border-b border-slate-200">
                            <td class="py-4 w-48 font-semibold text-slate-700">Kode Part</td>
                            <td class="py-4 w-10 text-center">:</td>
                            <td class="py-4 text-slate-800">{{ $barang->kode }}</td>
                        </tr>

                        <tr class="border-b border-slate-200">
                            <td class="py-4 font-semibold text-slate-700">Nama Barang</td>
                            <td class="py-4 text-center">:</td>
                            <td class="py-4 text-slate-800">{{ $barang->nama_barang }}</td>
                        </tr>

                        <tr class="border-b border-slate-200">
                            <td class="py-4 font-semibold text-slate-700">Kategori</td>
                            <td class="py-4 text-center">:</td>
                            <td class="py-4 text-slate-800">{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                        </tr>

                        <tr class="border-b border-slate-200">
                            <td class="py-4 font-semibold text-slate-700">Merek</td>
                            <td class="py-4 text-center">:</td>
                            <td class="py-4 text-slate-800">{{ $barang->brand->nama_brand ?? '-' }}</td>
                        </tr>

                        <tr class="border-b border-slate-200">
                            <td class="py-4 font-semibold text-slate-700">Tipe Kendaraan</td>
                            <td class="py-4 text-center">:</td>
                            <td class="py-4 text-slate-800">{{ $barang->tipe ?? '-' }}</td>
                        </tr>

                        <tr class="border-b border-slate-200">
                            <td class="py-4 font-semibold text-slate-700">Supplier</td>
                            <td class="py-4 text-center">:</td>
                            <td class="py-4 text-slate-800">
                                {{ $masukTerakhir?->supplier?->nama_supplier ?? '-' }}
                            </td>
                        </tr>

                        <tr class="border-b border-slate-200">
                            <td class="py-4 font-semibold text-slate-700">Stok</td>
                            <td class="py-4 text-center">:</td>
                            <td class="py-4">
                                @php
                                    $stok = (int) $barang->stok;
                                    if ($stok <= 0)      { $stokClass = 'bg-red-100 text-red-700';       $stokText = 'Habis'; }
                                    elseif ($stok <= 10) { $stokClass = 'bg-yellow-100 text-yellow-700'; $stokText = 'Menipis'; }
                                    else                 { $stokClass = 'bg-green-100 text-green-700';   $stokText = 'Aman'; }
                                @endphp
                                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-semibold {{ $stokClass }}">
                                    {{ $barang->stok }} | {{ $stokText }}
                                </span>
                            </td>
                        </tr>

                        <tr class="border-b border-slate-200">
                            <td class="py-4 font-semibold text-slate-700">Harga Beli</td>
                            <td class="py-4 text-center">:</td>
                            <td class="py-4 font-semibold text-blue-600">
                                Rp {{ number_format($masukTerakhir?->harga_beli ?? 0, 0, ',', '.') }}
                            </td>
                        </tr>

                        <tr class="border-b border-slate-200">
                            <td class="py-4 font-semibold text-slate-700">Harga Jual</td>
                            <td class="py-4 text-center">:</td>
                            <td class="py-4 font-semibold text-green-600">
                                Rp {{ number_format($barang->harga_jual ?? 0, 0, ',', '.') }}
                            </td>
                        </tr>

                        <tr>
                            <td class="py-4 font-semibold text-slate-700 align-top">Deskripsi</td>
                            <td class="py-4 text-center align-top">:</td>
                            <td class="py-4 text-slate-600 leading-relaxed">
                                {{ $barang->deskripsi ?? '-' }}
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

@endsection