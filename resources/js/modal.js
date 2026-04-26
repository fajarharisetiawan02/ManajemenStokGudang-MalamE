function openModal() {
    const modal = document.getElementById('modalTambah');
    if (!modal) return;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeModal() {
    const modal = document.getElementById('modalTambah');
    if (!modal) return;

    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// biar bisa dipanggil dari HTML
window.openModal = openModal;
window.closeModal = closeModal;