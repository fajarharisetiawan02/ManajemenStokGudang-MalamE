function openModal() {
    const modal = document.getElementById('modalTambah');
    if (!modal) return;

    const form = modal.querySelector('form');

    // mode tambah
    form.classList.remove('edit-mode');

    // reset form
    form.reset();

    form.action = "/data-barang";

    // hapus method PUT jika ada
    const method = form.querySelector('input[name="_method"]');
    if (method) method.remove();

    // ubah title
    document.getElementById('modalTitle').innerText = "Tambah Barang";
    document.getElementById('modalSubtitle').innerText = "Isi data barang baru";

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
    const form = modal.querySelector('form');

    modal.classList.remove('hidden');
    modal.classList.add('flex');

    form.classList.add('edit-mode');

    form.querySelector('input[name="no_part"]').value = no_part;
    form.querySelector('input[name="nama_barang"]').value = nama;
    form.querySelector('select[name="brand"]').value = brand;
    form.querySelector('input[name="stok"]').value = stok;
    form.querySelector('input[name="harga"]').value = harga;
    
    form.action = "/data-barang/" + id;

    let method = form.querySelector('input[name="_method"]');
    if (!method) {
        method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        method.value = 'PUT';
        form.appendChild(method);
    }

    document.getElementById('modalTitle').innerText = "Edit Barang";
    document.getElementById('modalSubtitle').innerText = "Ubah data barang";

    const submitBtn = form.querySelector('button[type="submit"]');
    if (submitBtn) submitBtn.innerText = "Update";
}

// UX
document.addEventListener("click", function (e) {
    const modal = document.getElementById('modalTambah');
    if (e.target === modal) closeModal();
});

document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") closeModal();
});

window.openModal = openModal;
window.closeModal = closeModal;
window.editData = editData;