@extends('layouts.app')

@section('title', 'Supplier')

@section('content')
<div class="w-full space-y-4">

    <!-- TABLE CARD -->
    <div class="w-full bg-white border border-gray-200 shadow-sm overflow-hidden">

        <!-- HEADER -->
        <div class="bg-slate-600 px-4 pt-3">

            <div
                class="inline-flex items-center bg-white px-5 py-2 text-sm font-medium text-slate-700 border border-gray-200 border-b-0">
                List
            </div>

        </div>
        <div class="p-4">

            <button type="button" onclick="setModeTambahSupplier()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">

                <i class="fas fa-plus"></i>
                Tambah Supplier
            </button>

        </div>

        <form method="GET" action="{{ url('/admin/supplier') }}">

            <div class="px-4 pb-4 flex flex-wrap items-center gap-3">

                <!-- SEARCH -->
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari supplier..."
                    class="w-64 border border-gray-300 rounded px-3 py-2">

                <!-- FILTER -->
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">

                    <i class="fas fa-filter mr-1"></i>
                    Filter

                </button>

                <!-- RESET -->
                <a href="{{ url('/admin/supplier') }}"
                    class="border border-gray-300 px-4 py-2 rounded hover:bg-gray-50">

                    Reset

                </a>

            </div>

        </form>

        <div class="flex justify-between items-center px-4 py-3 border-b bg-white">

            <div class="flex items-center gap-2 text-sm">

                <span>Show</span>

                <select onchange="window.location='?per_page='+this.value"
                    class="h-10 min-w-[75px] border border-gray-300 rounded-md px-3 pr-8 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

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

                <thead class="bg-gray-50">

                    <tr>
                        <th class="px-3 py-3 border text-left">No</th>
                        <th class="px-3 py-3 border text-left">Nama Supplier</th>
                        <th class="px-3 py-3 border text-left">Telepon</th>
                        <th class="px-3 py-3 border text-left">Email</th>
                        <th class="px-3 py-3 border text-left">Alamat</th>
                        <th class="px-3 py-3 border text-center">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($suppliers as $item)

                    <tr class="hover:bg-gray-50">

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
                                    class="px-3 py-2 border border-gray-300 rounded bg-white hover:bg-gray-50 text-sm">

                                    <i class="fas fa-pen mr-1"></i>
                                    Edit

                                </button>

                                <!-- DELETE -->
                                <form id="delete-form-{{ $item->id }}" action="{{ url('/admin/supplier/'.$item->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="button" onclick="confirmDelete({{ $item->id }})"
                                        class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded text-sm">

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

            <div class="flex items-center">
                {{ $suppliers->withQueryString()->links() }}
            </div>

            <div class="flex items-center gap-2">

                <button class="border px-3 py-1 rounded text-gray-500">
                    Previous
                </button>

                <button class="border px-3 py-1 rounded bg-gray-100">
                    {{ $suppliers->currentPage() }}
                </button>

                <button class="border px-3 py-1 rounded text-gray-500">
                    Next
                </button>

            </div>

        </div>

    </div>

</div>

<!-- MODAL SUPPLIER -->
<div id="modalSupplier" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">

    <!-- MODAL -->
    <div class="relative bg-white w-full max-w-3xl border border-gray-300 shadow-xl">

        <!-- HEADER -->
        <div class="bg-slate-600 text-white px-5 py-4 flex items-center justify-between">

            <div>

                <h2 id="modalSupplierTitle" class="text-xl font-bold">
                    Tambah Supplier
                </h2>

                <p id="modalSupplierSubtitle" class="text-xs text-slate-200 mt-1">
                    Lengkapi data supplier baru di bawah ini.
                </p>

            </div>

            <button type="button" onclick="closeSupplierModal()" class="text-white text-xl hover:text-gray-200">

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
                        class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">

                </div>

                <!-- Telepon -->
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Telepon
                    </label>

                    <input type="text" name="telepon" id="supplier_telepon" required placeholder="Contoh: 0812xxxx"
                        class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">

                </div>

                <!-- Email -->
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Email
                    </label>

                    <input type="email" name="email" id="supplier_email" placeholder="supplier@email.com"
                        class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500">

                </div>

                <!-- Alamat -->
                <div class="md:col-span-2">

                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Alamat
                    </label>

                    <textarea name="alamat" id="supplier_alamat" rows="4" required placeholder="Alamat lengkap supplier"
                        class="w-full border border-gray-300 px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500"></textarea>

                </div>

            </div>

            <!-- FOOTER -->
            <div class="flex justify-end gap-2 mt-5 pt-4 border-t">

                <button type="button" onclick="closeSupplierModal()"
                    class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700">

                    Batal

                </button>

                <button id="submitSupplierBtn" type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white">

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
