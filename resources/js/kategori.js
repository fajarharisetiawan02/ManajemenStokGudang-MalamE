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
        const inputFotoReset = document.getElementById('input_foto');
        if (inputFotoReset) inputFotoReset.value = '';
        const fotoLabelReset = document.getElementById('foto_label');
        if (fotoLabelReset) fotoLabelReset.textContent = '';
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
        const inputFoto = document.getElementById('input_foto');
        if (inputFoto) inputFoto.value = '';
        const fotoLabel = document.getElementById('foto_label');
        if (fotoLabel) fotoLabel.textContent = '';
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

    // ==== VALIDASI FILE FOTO ==== //
    function validasiFoto(file) {
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        const maxSize = 2 * 1024 * 1024; // 2MB
        if (!allowedTypes.includes(file.type)) {
            return 'Format file tidak didukung. Hanya JPG, JPEG, dan PNG yang diperbolehkan.';
        }
        if (file.size > maxSize) {
            return 'Ukuran file melebihi batas maksimal 2MB.';
        }
        return null;
    }

    // Listener nama file foto
    document.addEventListener('change', function(e) {
        if (e.target && e.target.id === 'input_foto') {
            const label = document.getElementById('foto_label');
            if (!label) return;
            label.textContent = e.target.files.length > 0 ? e.target.files[0].name : '';
        }
    });

    // Validasi saat file dipilih
    document.addEventListener('change', function (e) {
        if (e.target && e.target.name === 'foto') {
            const file = e.target.files[0];
            if (!file) return;
            const error = validasiFoto(file);
            if (error) {
                e.target.value = '';
                Swal.fire({
                    icon: 'warning',
                    title: 'Format File Tidak Didukung!',
                    text: error,
                    confirmButtonColor: '#2563eb',
                    confirmButtonText: 'OK',
                    backdrop: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        const swalContainer = document.querySelector('.swal2-container');
                        if (swalContainer) {
                            swalContainer.style.zIndex = '999999';
                            swalContainer.style.pointerEvents = 'all';
                        }
                        const modal = document.getElementById('modalKategori');
                        if (modal) modal.style.pointerEvents = 'none';
                    },
                    didClose: () => {
                        const modal = document.getElementById('modalKategori');
                        if (modal) modal.style.pointerEvents = '';
                    },
                });
            }
        }
    });

    // Validasi saat submit
    document.getElementById('formKategori').addEventListener('submit', function (e) {
        const inputFile = this.querySelector('input[name="foto"]');
        if (inputFile && inputFile.files.length > 0) {
            const error = validasiFoto(inputFile.files[0]);
            if (error) {
                e.preventDefault();
                inputFile.value = '';
                Swal.fire({
                    icon: 'warning',
                    title: 'Format File Tidak Didukung!',
                    text: error,
                    confirmButtonColor: '#2563eb',
                    confirmButtonText: 'OK',
                    backdrop: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        const swalContainer = document.querySelector('.swal2-container');
                        if (swalContainer) {
                            swalContainer.style.zIndex = '999999';
                            swalContainer.style.pointerEvents = 'all';
                        }
                        const modal = document.getElementById('modalKategori');
                        if (modal) modal.style.pointerEvents = 'none';
                    },
                    didClose: () => {
                        const modal = document.getElementById('modalKategori');
                        if (modal) modal.style.pointerEvents = '';
                    },
                });
            }
        }
    });

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