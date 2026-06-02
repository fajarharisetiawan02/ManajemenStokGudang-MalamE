@extends('layouts.app')

@section('title', 'Detail Barang')

@section('content')

<div class="w-full bg-white border border-gray-200 shadow-sm overflow-hidden">

    <!-- HEADER -->
        <div class="bg-slate-600 px-4 pt-3">

            <div
                class="inline-flex items-center bg-white px-5 py-2 text-sm font-medium text-slate-700 border border-gray-200 border-b-0">
                Detail
            </div>

        </div>

    <!-- ACTION -->
    <div class="p-4 border-b bg-white">

        <a href="{{ route('admin.data-barang.index') }}"
            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded hover:bg-gray-50">

            <i class="fas fa-arrow-left mr-2"></i>
            Kembali

        </a>

    </div>

    <!-- CONTENT -->
    <div class="p-6">

        <div class="grid lg:grid-cols-2 gap-8">

            <!-- GAMBAR -->
            <div>

                @php
                $gambarUtama = $barang->gambarBarang->first();
                $gambarList = $barang->gambarBarang->take(4);
                @endphp

                <!-- Gambar Utama -->
                <div class="border border-gray-200 rounded-lg overflow-hidden bg-gray-50">

                    @if($gambarUtama)

                    <img id="mainImage" src="{{ asset('uploads/barang/' . $gambarUtama->gambar) }}"
                        alt="{{ $barang->nama_barang }}" class="w-full h-[450px] object-contain p-4">

                    @else

                    <div class="h-[450px] flex items-center justify-center text-gray-400">
                        <div class="text-center">
                            <i class="fas fa-image text-5xl mb-3"></i>
                            <p>Tidak ada gambar</p>
                        </div>
                    </div>

                    @endif

                </div>

                <!-- Thumbnail 4 Kotak -->
                <div class="grid grid-cols-4 gap-3 mt-4">

                    @foreach($barang->gambarBarang->take(4) as $index => $gambar)

                    <button type="button" onclick="changeImage(this)"
                        data-image="{{ asset('uploads/barang/' . $gambar->gambar) }}"
                        class="thumb-btn overflow-hidden rounded-lg border {{ $index == 0 ? 'border-blue-500 border-2' : 'border-gray-200' }} hover:border-blue-400 transition">

                        <img src="{{ asset('uploads/barang/' . $gambar->gambar) }}" class="w-full h-20 object-cover">

                    </button>

                    @endforeach

                    @for($i = $barang->gambarBarang->count(); $i < 4; $i++) <div
                        class="h-20 rounded-lg border border-gray-200 bg-gray-50 flex items-center justify-center">

                        <i class="fas fa-image text-gray-300 text-xl"></i>

                </div>

                @endfor

            </div>
        </div>
        <!-- DETAIL -->
        <div>

            <table class="w-full">

                <tbody>

                    <tr class="border-b">
                        <td class="py-4 w-48 font-semibold text-gray-700">
                            Kode Part
                        </td>

                        <td class="py-4 w-10 text-center">:</td>

                        <td class="py-4">
                            {{ $barang->kode }}
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-4 font-semibold text-gray-700">
                            Nama Barang
                        </td>

                        <td class="py-4 text-center">:</td>

                        <td class="py-4">
                            {{ $barang->nama_barang }}
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-4 font-semibold text-gray-700">
                            Kategori
                        </td>

                        <td class="py-4 text-center">:</td>

                        <td class="py-4">
                            {{ $barang->kategori->nama_kategori ?? '-' }}
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-4 font-semibold text-gray-700">
                            Brand
                        </td>

                        <td class="py-4 text-center">:</td>

                        <td class="py-4">
                            {{ $barang->brand->nama_brand ?? '-' }}
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-4 font-semibold text-gray-700">
                            Supplier
                        </td>

                        <td class="py-4 text-center">:</td>

                        <td class="py-4">
                            {{ $barang->supplier->nama_supplier ?? '-' }}
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-4 font-semibold text-gray-700">
                            Stok
                        </td>

                        <td class="py-4 text-center">:</td>

                        <td class="py-4">
                            <span class="inline-flex px-3 py-1 bg-green-100 text-green-700 rounded text-sm font-medium">
                                {{ $barang->stok }}
                            </span>
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-4 font-semibold text-gray-700">
                            Harga Beli
                        </td>

                        <td class="py-4 text-center">:</td>

                        <td class="py-4 font-semibold text-blue-600">
                            Rp {{ number_format($barang->harga_beli,0,',','.') }}
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-4 font-semibold text-gray-700">
                            Harga Jual
                        </td>

                        <td class="py-4 text-center">:</td>

                        <td class="py-4 font-semibold text-green-600">
                            Rp {{ number_format($barang->harga_jual,0,',','.') }}
                        </td>
                    </tr>

                    <tr>
                        <td class="py-4 font-semibold text-gray-700 align-top">
                            Deskripsi
                        </td>

                        <td class="py-4 text-center align-top">:</td>

                        <td class="py-4 text-gray-600 leading-relaxed">
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
@section('script')
<script>
    function changeImage(button) {
        document.getElementById('mainImage').src =
            button.dataset.image;

        document.querySelectorAll('.thumb-btn').forEach(item => {
            item.classList.remove('border-blue-500', 'border-2');
            item.classList.add('border-gray-200');
        });

        button.classList.remove('border-gray-200');
        button.classList.add('border-blue-500', 'border-2');
    }
</script>
