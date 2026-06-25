if (document.getElementById('modalKategori')) {

    const storeUrl = document.getElementById('modalKategori').dataset.storeUrl;

    window.openTambah = function () {
        document.getElementById('modalTitleKategori').innerText    = 'Tambah Kategori';
        document.getElementById('modalSubtitleKategori').innerText = 'Lengkapi data kategori baru.';
        document.getElementById('submitKategoriBtnText').innerText = 'Simpan';
        document.getElementById('submitKategoriBtn').className =
            'px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition';
        document.getElementById('formKategori').action = storeUrl;
        document.getElementById('methodContainerKategori').innerHTML = '';
        document.getElementById('kategoriNama').value = '';
        showKategoriModal();
    }

    window.openEdit = function (id, nama) {
        document.getElementById('modalTitleKategori').innerText    = 'Edit Kategori';
        document.getElementById('modalSubtitleKategori').innerText = 'Perbarui data kategori.';
        document.getElementById('submitKategoriBtnText').innerText = 'Simpan Perubahan';
        document.getElementById('submitKategoriBtn').className =
            'px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg shadow-sm transition';
        document.getElementById('kategoriNama').value = nama;
        document.getElementById('formKategori').action = '/admin/kategori/' + id;
        document.getElementById('methodContainerKategori').innerHTML =
            '<input type="hidden" name="_method" value="PUT">';
        showKategoriModal();
    }

    window.showKategoriModal = function () {
        const modal = document.getElementById('modalKategori');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    window.closeKategoriModal = function () {
        const modal = document.getElementById('modalKategori');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }

}

if (document.getElementById('modalSupplier')) {

    const supplierModal           = document.getElementById('modalSupplier');
    const formSupplier            = document.getElementById('formSupplier');
    const methodContainerSupplier = document.getElementById('methodContainerSupplier');
    const modalSupplierTitle      = document.getElementById('modalSupplierTitle');
    const modalSupplierSubtitle   = document.getElementById('modalSupplierSubtitle');
    const submitSupplierBtn       = document.getElementById('submitSupplierBtn');
    const supplierBaseUrl         = supplierModal.dataset.baseUrl;

    window.openSupplierModal = function () {
        supplierModal.classList.remove('hidden');
        supplierModal.classList.add('flex');
        document.body.classList.add('overflow-hidden');
    }

    window.closeSupplierModal = function () {
        supplierModal.classList.add('hidden');
        supplierModal.classList.remove('flex');
        document.body.classList.remove('overflow-hidden');
    }

    window.setModeTambahSupplier = function () {
        formSupplier.reset();
        formSupplier.action = supplierBaseUrl;
        methodContainerSupplier.innerHTML = '';
        modalSupplierTitle.textContent    = 'Tambah Supplier';
        modalSupplierSubtitle.textContent = 'Lengkapi data supplier baru di bawah ini.';
        submitSupplierBtn.textContent     = 'Simpan';
        submitSupplierBtn.className       = 'px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition';
        openSupplierModal();
    }

    window.editSupplier = function (button) {
        const id      = button.dataset.id;
        const nama    = button.dataset.namaSupplier || '';
        const telepon = button.dataset.telepon || '';
        const email   = button.dataset.email || '';
        const alamat  = button.dataset.alamat || '';

        formSupplier.action = supplierBaseUrl + '/' + id;
        methodContainerSupplier.innerHTML = '<input type="hidden" name="_method" value="PUT">';
        modalSupplierTitle.textContent    = 'Edit Supplier';
        modalSupplierSubtitle.textContent = 'Perbarui data supplier yang dipilih di bawah ini.';
        submitSupplierBtn.textContent     = 'Simpan Perubahan';
        submitSupplierBtn.className       = 'px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg shadow-sm transition';

        document.getElementById('supplier_nama').value    = nama;
        document.getElementById('supplier_telepon').value = telepon;
        document.getElementById('supplier_email').value   = email;
        document.getElementById('supplier_alamat').value  = alamat;

        openSupplierModal();
    }

    window.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeSupplierModal();
    });

}