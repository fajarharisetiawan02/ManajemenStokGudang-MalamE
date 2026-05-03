function openModal() {
    const modal = document.getElementById('modalTambah');
    if (!modal) return;

    const form = modal.querySelector('form');
    if (!form) return;

    // mode tambah
    form.classList.remove('edit-mode');

    // reset form
    form.reset();

    // set action
    form.action = "/data-barang";

    // hapus method PUT jika ada
    const method = form.querySelector('input[name="_method"]');
    if (method) method.remove();

    // ubah title (AMAN)
    const title = document.getElementById('modalTitle');
    if (title) title.innerText = "Tambah Barang";

    const subtitle = document.getElementById('modalSubtitle');
    if (subtitle) subtitle.innerText = "Isi data barang baru";

    // tombol
    const submitBtn = form.querySelector('button[type="submit"]');
    if (submitBtn) submitBtn.innerText = "Simpan";

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeModal() {
    const modal = document.getElementById('modalTambah');
    if (!modal) return;

    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function editData(id, no_part, nama, brand, stok, harga) {
    const modal = document.getElementById('modalTambah');
    if (!modal) return;

    const form = modal.querySelector('form');
    if (!form) return;

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    form.classList.add('edit-mode');

    // isi data
    const noPart = form.querySelector('input[name="no_part"]');
    const namaBarang = form.querySelector('input[name="nama_barang"]');
    const brandSelect = form.querySelector('select[name="brand"]');
    const stokInput = form.querySelector('input[name="stok"]');
    const hargaInput = form.querySelector('input[name="harga"]');

    if (noPart) noPart.value = no_part;
    if (namaBarang) namaBarang.value = nama;
    if (brandSelect) brandSelect.value = brand;
    if (stokInput) stokInput.value = stok;
    if (hargaInput) hargaInput.value = harga;

    // action update
    form.action = "/data-barang/" + id;

    // method PUT
    let method = form.querySelector('input[name="_method"]');
    if (!method) {
        method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        form.appendChild(method);
    }
    method.value = 'PUT';

    // ubah title (AMAN)
    const title = document.getElementById('modalTitle');
    if (title) title.innerText = "Edit Barang";

    const subtitle = document.getElementById('modalSubtitle');
    if (subtitle) subtitle.innerText = "Ubah data barang";

    // tombol
    const submitBtn = form.querySelector('button[type="submit"]');
    if (submitBtn) submitBtn.innerText = "Update";
}

// UX klik luar modal
document.addEventListener("click", function (e) {
    const modal = document.getElementById('modalTambah');
    if (e.target === modal) closeModal();
});

// UX tombol ESC
document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") closeModal();
});

// global
window.openModal = openModal;
window.closeModal = closeModal;
window.editData = editData;