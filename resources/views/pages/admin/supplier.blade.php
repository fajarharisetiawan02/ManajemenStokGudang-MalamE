@extends('layouts.app')

@section('title', 'Supplier')

@section('content')
<div class="w-full space-y-4">

    <!-- TABLE CARD -->
    <div class="w-full bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

        <div class="p-4">

            <button type="button" onclick="setModeTambahSupplier()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm transition">
                <i class="fas fa-plus"></i>
                Tambah Supplier
            </button>

        </div>

        <form method="GET" action="{{ url('/admin/supplier') }}">

            <div class="px-4 pb-4 flex flex-wrap items-center gap-3">

                <!-- SEARCH -->
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari supplier..."
                    class="w-64 border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                <!-- FILTER -->
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow-sm transition">

                    <i class="fas fa-filter mr-1"></i>
                    Filter

                </button>

                <!-- RESET -->
                <a href="{{ url('/admin/supplier') }}"
                    class="border border-slate-300 px-4 py-2 rounded-lg hover:bg-slate-50 transition">

                    Reset

                </a>

            </div>

        </form>

        <div class="flex justify-between items-center px-4 py-3 border-b bg-white">

            <div class="flex items-center gap-2 text-sm">

                <span>Show</span>

                <select onchange="window.location='?per_page='+this.value"
                    class="h-10 min-w-[75px] border border-slate-300 rounded-lg" px-3 pr-8 text-sm bg-white
                    focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

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

        <div class="overflow-x-auto">

            <table class="w-full text-sm border-collapse">

                <thead class="bg-slate-50 text-slate-700">

                    <tr>
                        <th class="px-3 py-3 text-left font-semibold border">No</th>
                        <th class="px-3 py-3 text-left font-semibold border">Nama Supplier</th>
                        <th class="px-3 py-3 text-left font-semibold border">Telepon</th>
                        <th class="px-3 py-3 text-left font-semibold border">Email</th>
                        <th class="px-3 py-3 text-left font-semibold border">Alamat</th>
                        <th class="px-3 py-3 text-center font-semibold border">Aksi</th>
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
                            <a href="tel:{{ $item->telepon }}" class="text-blue-600 hover:underline">
                                {{ $item->telepon }}
                            </a>
                        </td>

                        <td class="px-3 py-4 border">
                            {{ $item->email ?? '-' }}
                        </td>

                        <td class="px-3 py-4 border">
                            {{ $item->alamat }}
                        </td>

                        <td class="px-3 py-4 border">

                            <div class="flex justify-center gap-2">

                                <!-- EDIT -->
                                <button type="button" data-id="{{ $item->id }}"
                                    data-nama-supplier="{{ $item->nama_supplier }}" data-telepon="{{ $item->telepon }}"
                                    data-email="{{ $item->email }}" data-alamat="{{ $item->alamat }}"
                                    onclick="editSupplier(this)"
                                    class="px-3 py-2 rounded-lg bg-amber-500 hover:bg-amber-600 text-white transition">
                                    <i class="fas fa-pen mr-1"></i>
                                    Edit

                                </button>

                                <!-- DELETE -->
                                <form id="delete-form-{{ $item->id }}" action="{{ url('/admin/supplier/'.$item->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="button" onclick="confirmDelete({{ $item->id }})"
                                        class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow-sm text-sm transition">

                                        <i class="fas fa-trash mr-1"></i>
                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" class="text-center py-10 border text-gray-500">
                            Belum ada data supplier
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

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

        {{-- Previous --}}
        <a href="{{ $suppliers->previousPageUrl() }}"
            class="border px-4 py-2 rounded text-gray-600 hover:bg-gray-50 {{ !$suppliers->onFirstPage() ? '' : 'pointer-events-none opacity-50' }}">
            Previous
        </a>

        {{-- Halaman Aktif --}}
        <span class="border px-4 py-2 rounded bg-gray-100 font-medium">
            {{ $suppliers->currentPage() }}
        </span>

        {{-- Next --}}
        <a href="{{ $suppliers->nextPageUrl() }}"
            class="border px-4 py-2 rounded text-gray-600 hover:bg-gray-50 {{ $suppliers->hasMorePages() ? '' : 'pointer-events-none opacity-50' }}">
            Next
        </a>

    </div>

</div>
    </div>

</div>

<!-- MODAL SUPPLIER -->
<div id="modalSupplier" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">

    <!-- MODAL -->
    <div class="relative bg-white w-full max-w-3xl rounded-xl border border-slate-200 shadow-2xl overflow-hidden">

        <!-- HEADER -->
        <div class="bg-slate-50 border-b border-slate-200 px-6 py-5 flex items-center justify-between">

            <div>

                <h2 id="modalSupplierTitle" class="text-xl font-bold text-slate-800">
                    Tambah Supplier
                </h2>

                <p id="modalSupplierSubtitle" class="text-sm text-slate-500 mt-1">
                    Lengkapi data supplier baru di bawah ini.
                </p>

            </div>

            <button type="button" onclick="closeSupplierModal()"
                class="w-9 h-9 rounded-lg hover:bg-slate-100 text-slate-500 hover:text-red-500 transition">

                <i class="fas fa-times"></i>

            </button>

        </div>

        <!-- FORM -->
        <form id="formSupplier" action="{{ url('/admin/supplier') }}" method="POST" class="p-5">

            @csrf

            <div id="methodContainerSupplier"></div>

            <div class="grid md:grid-cols-2 gap-4">

                <!-- Nama Supplier -->
                <div class="md:col-span-2">

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Supplier
                    </label>

                    <input type="text" name="nama" id="supplier_nama" required placeholder="Contoh: PT Astra"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                </div>

                <!-- Telepon -->
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Telepon
                    </label>

                    <input type="text" name="telepon" id="supplier_telepon" required placeholder="Contoh: 0812xxxx"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                </div>

                <!-- Email -->
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Email
                    </label>

                    <input type="email" name="email" id="supplier_email" placeholder="supplier@email.com"
                        class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                </div>

                <!-- Alamat -->
                <div class="md:col-span-2">

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Alamat
                    </label>

                    <textarea name="alamat" id="supplier_alamat" rows="4" required placeholder="Alamat lengkap supplier"
                        class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                    </textarea>

                </div>

            </div>

            <!-- FOOTER -->
            <div class="flex justify-end gap-2 mt-5 pt-4 border-t">

                <button type="button" onclick="closeSupplierModal()"
                    class="px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-lg">
                    Batal

                </button>

                <button id="submitSupplierBtn" type="submit"
                    class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-sm transition">

                    Simpan Supplier

                </button>

            </div>

        </form>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const supplierModal = document.getElementById('modalSupplier');
        const formSupplier = document.getElementById('formSupplier');
        const methodContainerSupplier = document.getElementById('methodContainerSupplier');
        const modalSupplierTitle = document.getElementById('modalSupplierTitle');
        const modalSupplierSubtitle = document.getElementById('modalSupplierSubtitle');
        const submitSupplierBtn = document.getElementById('submitSupplierBtn');

        window.openSupplierModal = function () {
            supplierModal.classList.remove('hidden');
            supplierModal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        window.closeSupplierModal = function () {
            supplierModal.classList.add('hidden');
            supplierModal.classList.remove('flex');
            document.body.style.overflow = '';
        }

window.setModeTambahSupplier = function () {

    formSupplier.reset();

    formSupplier.action = "{{ url('/admin/supplier') }}";

    methodContainerSupplier.innerHTML = '';

    modalSupplierTitle.textContent = 'Tambah Supplier';

    modalSupplierSubtitle.textContent =
        'Lengkapi data supplier baru di bawah ini.';

    submitSupplierBtn.textContent = 'Simpan Supplier';

    submitSupplierBtn.classList.remove(
        'bg-amber-500',
        'hover:bg-amber-600'
    );

    submitSupplierBtn.classList.add(
        'bg-blue-600',
        'hover:bg-blue-700'
    );

    openSupplierModal();
}

window.editSupplier = function (button) {

    const id = button.dataset.id;
    const nama = button.dataset.namaSupplier || '';
    const telepon = button.dataset.telepon || '';
    const email = button.dataset.email || '';
    const alamat = button.dataset.alamat || '';

    formSupplier.action =
        "{{ url('/admin/supplier') }}/" + id;

    methodContainerSupplier.innerHTML =
        '<input type="hidden" name="_method" value="PUT">';

    modalSupplierTitle.textContent = 'Edit Supplier';

    modalSupplierSubtitle.textContent =
        'Perbarui data supplier yang dipilih di bawah ini.';

    submitSupplierBtn.textContent = 'Update Supplier';

    submitSupplierBtn.classList.remove(
        'bg-blue-600',
        'hover:bg-blue-700'
    );

    submitSupplierBtn.classList.add(
        'bg-amber-500',
        'hover:bg-amber-600'
    );

    document.getElementById('supplier_nama').value = nama;
    document.getElementById('supplier_telepon').value = telepon;
    document.getElementById('supplier_email').value = email;
    document.getElementById('supplier_alamat').value = alamat;

    openSupplierModal();
}
        window.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeSupplierModal();
            }
        });

    });
</script>
@endsection
