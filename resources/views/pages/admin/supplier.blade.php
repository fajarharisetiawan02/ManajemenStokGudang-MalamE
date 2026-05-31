@extends('layouts.app')

@section('title', 'Supplier')

@section('content')
<div class="w-full space-y-4">

    <!-- FILTER CARD -->
    <div class="w-full bg-white border border-gray-200 rounded-none shadow-sm">
        <div class="p-4 flex flex-wrap items-center gap-3 w-full">
            <form method="GET" action="{{ url('/admin/supplier') }}"
                class="flex flex-wrap items-center gap-3 w-full xl:w-auto">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400 text-sm"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari supplier..."
                        class="pl-9 pr-4 py-2.5 w-64 border border-gray-300 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <select name="status"
                    class="px-4 py-2.5 border border-gray-300 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Supplier</option>
                    <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>

                <button type="submit"
                    class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm flex items-center gap-2 transition">
                    <i class="fas fa-filter"></i> Filter
                </button>

                <a href="{{ url('/admin/supplier') }}"
                    class="px-4 py-2.5 border border-gray-300 rounded-xl text-sm text-gray-600 hover:bg-gray-50 transition">
                    Reset
                </a>
            </form>

            <div class="ml-auto">
                <button type="button" data-modal-target="modalTambahSupplier" data-modal-toggle="modalTambahSupplier"
                    onclick="setModeTambahSupplier()"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl flex items-center gap-2 shadow-sm transition">
                    <i class="fas fa-plus"></i>
                    Tambah Supplier
                </button>
            </div>
        </div>
    </div>

    <!-- TABLE CARD -->
    <div class="w-full bg-white border border-gray-200 rounded-none shadow-sm overflow-hidden">
        <div class="overflow-x-auto w-full">
            <table class="w-full min-w-[1100px] text-[15px]">
                <thead class="bg-gray-100 text-gray-700 text-[13px] uppercase tracking-wide border-b border-gray-300">
                    <tr>
                        <th class="px-4 py-4 text-left font-semibold">No</th>
                        <th class="px-4 py-4 text-left font-semibold">Nama Supplier</th>
                        <th class="px-4 py-4 text-left font-semibold">Telepon</th>
                        <th class="px-4 py-4 text-left font-semibold">Alamat</th>
                        <th class="px-4 py-4 text-center font-semibold">Status</th>
                        <th class="px-4 py-4 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($suppliers as $item)
                    @php
                    $status = $item->status ?? 1;
                    @endphp

                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-4 text-gray-500 text-[15px]">
                            {{ $suppliers->firstItem() + $loop->index }}
                        </td>

                        <td class="px-4 py-4 font-semibold text-gray-800 text-[15px]">
                            {{ $item->nama_supplier }}
                        </td>

                        <td class="px-4 py-4 text-gray-600 text-[15px]">
                            <a href="tel:{{ $item->telepon }}" class="text-blue-600 hover:underline font-medium">
                                {{ $item->telepon }}
                            </a>
                        </td>

                        <td class="px-4 py-4 text-gray-600 text-[15px]">
                            <div class="flex items-center gap-1">
                                <i class="fas fa-map-marker-alt text-gray-400 text-xs"></i>
                                <span>{{ $item->alamat }}</span>
                            </div>
                        </td>

                        <td class="px-4 py-4 text-center">
                            @if($status == 1)
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                                Aktif
                            </span>
                            @else
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-red-50 text-red-700 border border-red-100">
                                Nonaktif
                            </span>
                            @endif
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex justify-center gap-2">
                                <button type="button" data-id="{{ $item->id }}"
                                    data-nama-supplier="{{ $item->nama_supplier }}" data-telepon="{{ $item->telepon }}"
                                    data-alamat="{{ $item->alamat }}" data-status="{{ $item->status }}"
                                    onclick="editSupplier(this)"
                                    class="w-9 h-9 rounded-md bg-amber-50 text-amber-600 hover:bg-amber-100 transition flex items-center justify-center">
                                    <i class="fas fa-pen text-xs"></i>
                                </button>

                                <form action="{{ route('admin.supplier.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="button" onclick="confirmDelete(this.form)"
                                        class="w-9 h-9 rounded-md bg-red-50 text-red-600 hover:bg-red-100 transition flex items-center justify-center">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-14">
                            <div class="flex flex-col items-center text-center text-gray-500">
                                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                                    <i class="fas fa-truck text-2xl text-gray-400"></i>
                                </div>

                                <p class="font-medium text-gray-700 text-[15px]">
                                    Belum ada data supplier
                                </p>

                                <p class="text-sm text-gray-500 mt-1">
                                    Klik “Tambah Supplier” untuk mulai input data.
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- TABLE FOOTER -->
        <div class="flex flex-wrap items-center justify-between gap-3 px-4 py-3 border-t border-gray-200 bg-white">

            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600">

                <div class="flex items-center gap-2">
                    <span>Page</span>

                    <a href="{{ $suppliers->onFirstPage() ? '#' : $suppliers->previousPageUrl() }}"
                        class="w-8 h-8 border border-gray-300 bg-gray-100 text-gray-500 hover:bg-gray-200 transition flex items-center justify-center {{ $suppliers->onFirstPage() ? 'pointer-events-none opacity-50' : '' }}">
                        <i class="fas fa-chevron-left text-xs"></i>
                    </a>

                    <div
                        class="w-12 h-8 border border-gray-300 flex items-center justify-center bg-white text-gray-700">
                        {{ $suppliers->currentPage() }}
                    </div>

                    <a href="{{ $suppliers->hasMorePages() ? $suppliers->nextPageUrl() : '#' }}"
                        class="w-8 h-8 border border-gray-300 bg-gray-100 text-gray-500 hover:bg-gray-200 transition flex items-center justify-center {{ $suppliers->hasMorePages() ? '' : 'pointer-events-none opacity-50' }}">
                        <i class="fas fa-chevron-right text-xs"></i>
                    </a>
                </div>

                <span>of {{ $suppliers->lastPage() }}</span>

                <form method="GET" action="{{ url('/admin/supplier') }}" class="flex items-center gap-2">

                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="hidden" name="status" value="{{ request('status') }}">

                    <span>View</span>

                    <select name="per_page" onchange="this.form.submit()"
                        class="h-9 w-[90px] px-3 pr-8 border border-gray-300 bg-white text-sm focus:outline-none rounded-md">

                        <option value="10" {{ request('per_page',10)==10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page')==25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page')==50 ? 'selected' : '' }}>50</option>

                    </select>

                    <span>records</span>
                </form>

            </div>

            <div class="text-sm text-gray-600">
                Found total {{ $suppliers->total() }} records
            </div>

        </div>
    </div>
</div>
<!-- MODAL SUPPLIER -->
<div id="modalSupplier"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm p-4 overflow-y-auto"
    onclick="closeSupplierModal()">

    <div class="bg-white w-full max-w-2xl rounded-3xl shadow-2xl border border-gray-100"
        onclick="event.stopPropagation()">

        <!-- HEADER -->
        <div class="px-7 py-5 border-b border-gray-100 flex items-start justify-between">
            <div>
                <h2 id="modalSupplierTitle" class="text-2xl font-bold text-gray-800">Tambah Supplier</h2>
                <p id="modalSupplierSubtitle" class="text-sm text-gray-500 mt-1">
                    Lengkapi data supplier baru di bawah ini.
                </p>
            </div>

            <button type="button" onclick="closeSupplierModal()"
                class="w-10 h-10 rounded-full hover:bg-gray-100 text-gray-400 hover:text-gray-700 transition flex items-center justify-center">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- FORM -->
        <form id="formSupplier" action="{{ url('/admin/supplier') }}" method="POST" class="p-7">
            @csrf
            <div id="methodContainerSupplier"></div>

            <div class="grid md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="text-sm font-semibold text-gray-700">Nama Supplier</label>
                    <input type="text" name="nama" id="supplier_nama" required placeholder="Contoh: PT Astra"
                        class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none placeholder:text-gray-400">
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-700">Telepon</label>
                    <input type="text" name="telepon" id="supplier_telepon" required placeholder="Contoh: 0812xxxx"
                        class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none placeholder:text-gray-400">
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-700">Status</label>
                    <select name="status" id="supplier_status"
                        class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm font-semibold text-gray-700">Alamat</label>
                    <textarea name="alamat" id="supplier_alamat" rows="4" required placeholder="Alamat lengkap supplier"
                        class="w-full mt-2 px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 outline-none placeholder:text-gray-400"></textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-6 mt-6 border-t border-gray-100">
                <button type="button" onclick="closeSupplierModal()"
                    class="px-6 py-3 rounded-2xl bg-gray-100 hover:bg-gray-200 text-gray-700">
                    Batal
                </button>

                <button id="submitSupplierBtn" type="submit"
                    class="px-7 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold">
                    Simpan Supplier
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const supplierModal = document.getElementById('modalSupplier');
    const formSupplier = document.getElementById('formSupplier');
    const methodContainerSupplier = document.getElementById('methodContainerSupplier');
    const modalSupplierTitle = document.getElementById('modalSupplierTitle');
    const modalSupplierSubtitle = document.getElementById('modalSupplierSubtitle');
    const submitSupplierBtn = document.getElementById('submitSupplierBtn');

    function openSupplierModal() {
        supplierModal.classList.remove('hidden');
        supplierModal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeSupplierModal() {
        supplierModal.classList.add('hidden');
        supplierModal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    function setModeTambahSupplier() {
        formSupplier.action = "{{ url('/admin/supplier') }}";
        methodContainerSupplier.innerHTML = '';
        modalSupplierTitle.textContent = 'Tambah Supplier';
        modalSupplierSubtitle.textContent = 'Lengkapi data supplier baru di bawah ini.';
        submitSupplierBtn.textContent = 'Simpan Supplier';

        document.getElementById('supplier_nama').value = '';
        document.getElementById('supplier_telepon').value = '';
        document.getElementById('supplier_alamat').value = '';
        document.getElementById('supplier_status').value = '1';

        openSupplierModal();
    }

    function editSupplier(button) {
        const id = button.dataset.id;
        const nama = button.dataset.namaSupplier || '';
        const telepon = button.dataset.telepon || '';
        const alamat = button.dataset.alamat || '';
        const status = button.dataset.status || '1';

        formSupplier.action = "{{ url('/admin/supplier') }}/" + id;
        methodContainerSupplier.innerHTML = '<input type="hidden" name="_method" value="PUT">';
        modalSupplierTitle.textContent = 'Edit Supplier';
        modalSupplierSubtitle.textContent = 'Perbarui data supplier yang dipilih di bawah ini.';
        submitSupplierBtn.textContent = 'Update Supplier';

        document.getElementById('supplier_nama').value = nama;
        document.getElementById('supplier_telepon').value = telepon;
        document.getElementById('supplier_alamat').value = alamat;
        document.getElementById('supplier_status').value = status;

        openSupplierModal();
    }

    window.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeSupplierModal();
        }
    });
</script>
@endsection