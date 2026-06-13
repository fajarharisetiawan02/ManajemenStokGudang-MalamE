if (document.getElementById('modalSupplier')) {

    const supplierModal         = document.getElementById('modalSupplier');
    const formSupplier          = document.getElementById('formSupplier');
    const methodContainerSupplier = document.getElementById('methodContainerSupplier');
    const modalSupplierTitle    = document.getElementById('modalSupplierTitle');
    const modalSupplierSubtitle = document.getElementById('modalSupplierSubtitle');
    const submitSupplierBtn     = document.getElementById('submitSupplierBtn');
    const supplierBaseUrl       = supplierModal.dataset.baseUrl;

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
        formSupplier.action = supplierBaseUrl;
        methodContainerSupplier.innerHTML = '';
        modalSupplierTitle.textContent    = 'Tambah Supplier';
        modalSupplierSubtitle.textContent = 'Lengkapi data supplier baru di bawah ini.';
        submitSupplierBtn.textContent     = 'Simpan Supplier';
        submitSupplierBtn.classList.remove('bg-amber-500', 'hover:bg-amber-600');
        submitSupplierBtn.classList.add('bg-blue-600', 'hover:bg-blue-700');
        openSupplierModal();
    }

    window.editSupplier = function (button) {
        const id     = button.dataset.id;
        const nama   = button.dataset.namaSupplier || '';
        const telepon = button.dataset.telepon || '';
        const email  = button.dataset.email || '';
        const alamat = button.dataset.alamat || '';

        formSupplier.action = supplierBaseUrl + '/' + id;
        methodContainerSupplier.innerHTML = '<input type="hidden" name="_method" value="PUT">';
        modalSupplierTitle.textContent    = 'Edit Supplier';
        modalSupplierSubtitle.textContent = 'Perbarui data supplier yang dipilih di bawah ini.';
        submitSupplierBtn.textContent     = 'Update Supplier';
        submitSupplierBtn.classList.remove('bg-blue-600', 'hover:bg-blue-700');
        submitSupplierBtn.classList.add('bg-amber-500', 'hover:bg-amber-600');

        document.getElementById('supplier_nama').value    = nama;
        document.getElementById('supplier_telepon').value = telepon;
        document.getElementById('supplier_email').value   = email;
        document.getElementById('supplier_alamat').value  = alamat;

        openSupplierModal();
    }

    window.confirmDelete = function (id) {
        Swal.fire({
            title: 'Hapus Supplier?',
            text: 'Data yang dihapus tidak dapat dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#94a3b8',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    window.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeSupplierModal();
    });

}