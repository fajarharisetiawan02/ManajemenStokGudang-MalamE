@extends('layouts.app')

@section('title', __('app.title_supplier'))
@section('page_title', __('app.supplier'))

@section('content')
    <div class="w-full space-y-4">

        <!-- TABLE CARD -->
        <div class="w-full bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

            <div class="p-4">
                <button type="button" onclick="setModeTambahSupplier()"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg shadow-sm transition">
                    <i class="fas fa-plus mr-1"></i> Tambah Supplier
                </button>
            </div>

            <form method="GET" action="{{ url('/admin/supplier') }}">
                <div class="px-4 pb-4 flex flex-wrap items-center gap-3">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari supplier..."
                        class="w-full md:w-64 border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder:text-slate-400 placeholder:font-normal placeholder:text-sm">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg shadow-sm transition">
                        <i class="fas fa-filter mr-1"></i> Filter
                    </button>
                    <a href="{{ url('/admin/supplier') }}"
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
                        <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
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
                            <th class="px-4 py-4 text-center text-sm font-bold border w-44">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @forelse($suppliers as $item)
                            <tr class="hover:bg-slate-50 transition-colors duration-150">
                                <td class="px-4 py-4 border text-center text-black">
                                    {{ $suppliers->firstItem() + $loop->index }}</td>
                                <td class="px-4 py-4 border text-black max-w-xs break-words">{{ $item->nama_supplier }}</td>
                                <td class="px-4 py-4 border text-black">{{ $item->telepon }}</td>
                                <td class="px-4 py-4 border text-black">{{ $item->email ?? '-' }}</td>
                                <td class="px-4 py-4 border text-black max-w-xs break-words">{{ $item->alamat }}</td>
                                <td class="px-4 py-4 border">
                                    <div class="flex justify-center items-center gap-2 flex-nowrap">
                                        <button type="button" data-id="{{ $item->id }}"
                                            data-nama-supplier="{{ $item->nama_supplier }}"
                                            data-telepon="{{ $item->telepon }}" data-email="{{ $item->email }}"
                                            data-alamat="{{ $item->alamat }}" onclick="editSupplier(this)"
                                            class="inline-flex items-center px-3 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm rounded-lg transition whitespace-nowrap">
                                            <i class="fas fa-pen mr-1"></i> Edit
                                        </button>
                                        <form id="delete-form-{{ $item->id }}"
                                            action="{{ url('/admin/supplier/' . $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete(this.form)"
                                                class="inline-flex items-center px-3 py-2 bg-red-500 hover:bg-red-600 text-white text-sm rounded-lg transition whitespace-nowrap">
                                                <i class="fas fa-trash mr-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="border">
                                    <div class="flex flex-col items-center justify-center py-10 text-slate-400">
                                        <i class="fas fa-truck text-4xl mb-3 text-slate-300"></i>
                                        <p>Belum ada data supplier</p>
                                    </div>
                                </td>
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
                    <a href="{{ $suppliers->currentPage() > 1 ? $suppliers->url($suppliers->currentPage() - 1) : '#' }}"
                        class="flex items-center h-8 px-4 rounded-lg border border-slate-200 bg-white
                    text-slate-600 hover:bg-slate-100 text-sm transition
                    {{ $suppliers->onFirstPage() ? 'pointer-events-none opacity-50' : '' }}">
                        Sebelumnya
                    </a>
                    <span
                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-600 text-white font-semibold text-xs">
                        {{ $suppliers->currentPage() }}
                    </span>
                    <a href="{{ $suppliers->hasMorePages() ? $suppliers->url($suppliers->currentPage() + 1) : '#' }}"
                        class="flex items-center h-8 px-4 rounded-lg border border-slate-200 bg-white
                    text-slate-600 hover:bg-slate-100 text-sm transition
                    {{ !$suppliers->hasMorePages() ? 'pointer-events-none opacity-50' : '' }}">
                        Berikutnya
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- MODAL SUPPLIER -->
    <div id="modalSupplier" data-base-url="{{ url('/admin/supplier') }}"
        class="fixed z-[9999] hidden items-start justify-center overflow-y-auto backdrop-blur-sm bg-black/40"
        style="top:0;left:0;right:0;bottom:0;margin:0;padding:1.5rem 1rem;">

        <div class="bg-white w-full max-w-3xl rounded-xl shadow-2xl border border-slate-200 flex flex-col my-auto"
            onclick="event.stopPropagation()">

            <div class="px-6 py-5 bg-slate-50 border-b border-slate-200 flex items-center justify-between rounded-t-xl">
                <div>
                    <h2 id="modalSupplierTitle" class="text-xl font-bold text-slate-800">Tambah Supplier</h2>
                    <p id="modalSupplierSubtitle" class="text-sm text-slate-500 mt-1">Lengkapi data supplier baru di bawah
                        ini.</p>
                </div>
                <button type="button" onclick="closeSupplierModal()"
                    class="w-9 h-9 rounded-lg hover:bg-slate-100 text-slate-500 hover:text-red-500 transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="formSupplier" action="{{ url('/admin/supplier') }}" method="POST" class="p-6" autocomplete="off">
                @csrf
                <div id="methodContainerSupplier"></div>
                <div class="grid md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700">Nama Supplier</label>
                        <input type="text" name="nama" id="supplier_nama" required placeholder="Contoh: PT Astra"
                            class="w-full mt-2 border border-slate-300 rounded-lg px-4 py-2.5 text-sm text-slate-800 outline-none bg-white
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        placeholder:text-slate-400 placeholder:font-normal placeholder:text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Telepon</label>
                        <input type="text" name="telepon" id="supplier_telepon" required
                            placeholder="Contoh: 0812xxxx"
                            class="w-full mt-2 border border-slate-300 rounded-lg px-4 py-2.5 text-sm text-slate-800 outline-none bg-white
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        placeholder:text-slate-400 placeholder:font-normal placeholder:text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Email</label>
                        <input type="email" name="email" id="supplier_email" required
                            placeholder="supplier@email.com"
                            class="w-full mt-2 border border-slate-300 rounded-lg px-4 py-2.5 text-sm text-slate-800 outline-none bg-white
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                        placeholder:text-slate-400 placeholder:font-normal placeholder:text-sm">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700">Alamat</label>
                        <textarea name="alamat" id="supplier_alamat" rows="3" required placeholder="Alamat lengkap supplier"
                            class="w-full mt-2 border border-slate-300 rounded-lg px-4 py-2.5 text-sm text-slate-800 outline-none bg-white
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none
                        placeholder:text-slate-400 placeholder:font-normal placeholder:text-sm"></textarea>
                    </div>
                </div>
                <div class="flex justify-end gap-3 pt-5 mt-5 border-t border-slate-200">
                    <button type="button" onclick="closeSupplierModal()"
                        class="px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg transition">
                        Batal
                    </button>
                    <button id="submitSupplierBtn" type="submit"
                        class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                        Simpan
                    </button>
                </div>
            </form>

        </div>

    </div>

@endsection
