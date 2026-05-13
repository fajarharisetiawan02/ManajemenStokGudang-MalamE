       // =========================
    // OPEN MODAL TAMBAH
    // =========================
    function openModal() {
        const modal = document.getElementById('modalTambah');
        if (!modal) return;

        const form = modal.querySelector('form');
        if (!form) return;

        // reset form
        form.reset();

        // action tambah
        form.action = "/admin/data-barang";

        // hapus method PUT jika ada
        const method = form.querySelector('input[name="_method"]');
        if (method) method.remove();

        // title
        const title = document.getElementById('modalTitle');
        if (title) title.innerText = "Tambah Barang Baru";

        // subtitle
        const subtitle = document.getElementById('modalSubtitle');
        if (subtitle) subtitle.innerText = "Lengkapi data barang di bawah ini.";

        // tombol submit
        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) submitBtn.innerText = "Simpan";

        // tampil modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    // =========================
    // CLOSE MODAL
    // =========================
    function closeModal() {
        const modal = document.getElementById('modalTambah');
        if (!modal) return;

        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // =========================
    // EDIT DATA
    // =========================
    function editData(
        id,
        no_part,
        nama_barang,
        kategori_id,
        brand,
        stok,
        harga,
        supplier_id
    ) {

        const modal = document.getElementById('modalTambah');
        if (!modal) return;

        const form = modal.querySelector('form');
        if (!form) return;

        // tampil modal
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        // isi input
        const noPartInput = form.querySelector('input[name="no_part"]');
        const namaBarangInput = form.querySelector('input[name="nama_barang"]');
        const kategoriSelect = form.querySelector('select[name="kategori_id"]');
        const brandSelect = form.querySelector('select[name="brand"]');
        const stokInput = form.querySelector('input[name="stok"]');
        const hargaInput = form.querySelector('input[name="harga"]');
        const supplierSelect = form.querySelector('select[name="supplier_id"]');

        if (noPartInput) noPartInput.value = no_part || '';
        if (namaBarangInput) namaBarangInput.value = nama_barang || '';
        if (kategoriSelect) kategoriSelect.value = kategori_id || '';
        if (brandSelect) brandSelect.value = brand || '';
        if (stokInput) stokInput.value = stok || '';
        if (hargaInput) hargaInput.value = harga || '';
        if (supplierSelect) supplierSelect.value = supplier_id || '';

        // action update
        form.action = "/admin/data-barang/" + id;

        // method PUT
        let method = form.querySelector('input[name="_method"]');

        if (!method) {
            method = document.createElement('input');
            method.type = 'hidden';
            method.name = '_method';
            form.appendChild(method);
        }

        method.value = 'PUT';

        // title edit
        const title = document.getElementById('modalTitle');
        if (title) title.innerText = "Edit Barang";

        // subtitle edit
        const subtitle = document.getElementById('modalSubtitle');
        if (subtitle) subtitle.innerText = "Perbarui data barang di bawah ini.";

        // tombol update
        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) submitBtn.innerText = "Update";
    }

    // =========================
    // CLICK OUTSIDE MODAL
    // =========================
    document.addEventListener("click", function (e) {
        const modal = document.getElementById('modalTambah');

        if (e.target === modal) {
            closeModal();
        }
    });

    // =========================
    // ESC CLOSE MODAL
    // =========================
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            closeModal();
        }
    });

    // =========================
    // DELETE CONFIRM
    // =========================
    function confirmDelete(form) {
        Swal.fire({
            title: 'Yakin hapus data ini?',
            text: 'Data yang dihapus tidak bisa dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    // =========================
    // GLOBAL FUNCTION
    // =========================
    window.openModal = openModal;
    window.closeModal = closeModal;
    window.editData = editData;
    window.confirmDelete = confirmDelete;
