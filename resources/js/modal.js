// ==== OPEN MODAL TAMBAH ==== //
function openModal() {
    const modal = document.getElementById('modalBarang');
    if (!modal) return;

    const form = document.getElementById('formBarang');
    if (!form) return;

    form.reset();
    form.action = "/admin/data-barang";

    const methodContainer = document.getElementById('methodContainer');
    if (methodContainer) methodContainer.innerHTML = '';

    const title = document.getElementById('modalTitle');
    if (title) title.innerText = 'Tambah Barang';

    const subtitle = document.getElementById('modalSubtitle');
    if (subtitle) subtitle.innerText = 'Lengkapi data barang baru di bawah ini.';

    const submitBtn = document.getElementById('submitBtn');
    if (submitBtn) {
        submitBtn.innerText = 'Simpan';
        submitBtn.classList.remove('bg-amber-500', 'hover:bg-amber-600');
        submitBtn.classList.add('bg-blue-600', 'hover:bg-blue-700');
    }

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

// ==== CLOSE MODAL ==== //
function closeModal() {
    const modal = document.getElementById('modalBarang');
    if (!modal) return;

    modal.classList.remove('flex');
    modal.classList.add('hidden');
}

// ==== EDIT DATA ==== //
function editData(button) {
    const modal = document.getElementById('modalBarang');
    const form = document.getElementById('formBarang');
    if (!modal || !form) return;

    form.action = "/admin/data-barang/" + button.dataset.id;

    const noPart = form.querySelector('input[name="no_part"]');
    const namaBarang = form.querySelector('input[name="nama_barang"]');
    const kategori = form.querySelector('select[name="kategori_id"]');
    const brand = form.querySelector('select[name="brand"]');
    const stok = form.querySelector('input[name="stok"]');
    const harga = form.querySelector('input[name="harga"]');
    const supplier = form.querySelector('select[name="supplier_id"]');

    if (noPart) noPart.value = button.dataset.noPart || '';
    if (namaBarang) namaBarang.value = button.dataset.namaBarang || '';
    if (kategori) kategori.value = button.dataset.kategoriId || '';
    if (stok) stok.value = button.dataset.stok || '';
    if (harga) harga.value = button.dataset.harga || '';
    if (supplier) supplier.value = button.dataset.supplierId || '';

    if (brand) {
        const target = String(button.dataset.brand || '').trim().toLowerCase();
        const match = Array.from(brand.options).find(option => {
            const val = String(option.value || '').trim().toLowerCase();
            const txt = String(option.textContent || '').trim().toLowerCase();
            return val === target || txt === target;
        });
        brand.value = match ? match.value : '';
    }

    const methodContainer = document.getElementById('methodContainer');
    if (methodContainer) {
        methodContainer.innerHTML = '<input type="hidden" name="_method" value="PUT">';
    }

    const title = document.getElementById('modalTitle');
    if (title) title.innerText = 'Edit Barang';

    const subtitle = document.getElementById('modalSubtitle');
    if (subtitle) subtitle.innerText = 'Perbarui data barang di bawah ini.';

    const submitBtn = document.getElementById('submitBtn');
    if (submitBtn) {
        submitBtn.innerText = 'Update';
        submitBtn.classList.remove('bg-blue-600', 'hover:bg-blue-700');
        submitBtn.classList.add('bg-amber-500', 'hover:bg-amber-600');
    }

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

// ==== PREVIEW GAMBAR 1 FOTO ==== //
function showImage(src) {
    const preview = document.getElementById('previewImage');
    const modal = document.getElementById('imageModal');
    const thumbGallery = document.getElementById('thumbGallery');

    if (!preview || !modal) return;

    preview.src = src;
    if (thumbGallery) thumbGallery.innerHTML = '';

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

// ==== PREVIEW GAMBAR MULTIPLE ==== //
function showImages(images) {
    const preview = document.getElementById('previewImage');
    const modal = document.getElementById('imageModal');
    const thumbGallery = document.getElementById('thumbGallery');

    if (!preview || !modal || !thumbGallery) return;

    let imageList = images;

    if (typeof images === 'string') {
        try {
            imageList = JSON.parse(images);
        } catch (e) {
            imageList = [images];
        }
    }

    if (!Array.isArray(imageList)) {
        imageList = [imageList];
    }

    imageList = imageList.filter(Boolean);

    if (imageList.length === 0) {
        showNoImage();
        return;
    }

    preview.src = imageList[0];
    thumbGallery.innerHTML = '';

    imageList.forEach((src, index) => {
        const button = document.createElement('button');
        button.type = 'button';
        button.className =
            'rounded-xl overflow-hidden border transition duration-200 ' +
            (index === 0
                ? 'border-blue-600 ring-2 ring-blue-200'
                : 'border-gray-200 hover:border-blue-300');

        button.innerHTML = `<img src="${src}" class="w-full h-20 object-cover">`;

        button.addEventListener('click', function () {
            preview.src = src;

            thumbGallery.querySelectorAll('button').forEach(btn => {
                btn.classList.remove('border-blue-600', 'ring-2', 'ring-blue-200');
                btn.classList.add('border-gray-200');
            });

            button.classList.remove('border-gray-200');
            button.classList.add('border-blue-600', 'ring-2', 'ring-blue-200');
        });

        thumbGallery.appendChild(button);
    });

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

// ==== SWITCH PREVIEW GALLERY ==== //
function switchPreview(src) {
    const preview = document.getElementById('previewImage');
    if (preview) preview.src = src;
}

// ==== CLOSE PREVIEW GAMBAR ==== //
function closeImage() {
    const modal = document.getElementById('imageModal');
    const thumbGallery = document.getElementById('thumbGallery');
    const preview = document.getElementById('previewImage');

    if (!modal) return;

    if (thumbGallery) thumbGallery.innerHTML = '';
    if (preview) preview.src = '';

    modal.classList.remove('flex');
    modal.classList.add('hidden');
}

// ==== NO IMAGE ==== //
function showNoImage() {
    Swal.fire({
        icon: 'info',
        title: 'Tidak Ada Gambar',
        text: 'Produk ini belum memiliki gambar',
        confirmButtonColor: '#2563eb'
    });
}

// ==== DELETE CONFIRM ==== //
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

// ==== CLICK OUTSIDE MODAL ==== //
document.addEventListener("click", function (e) {
    const imageModal = document.getElementById('imageModal');

    if (imageModal && e.target === imageModal) {
        closeImage();
    }
});

// ==== ESC CLOSE ==== //
document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
        closeImage();
    }
});

// ==== GLOBAL FUNCTION ==== //
window.openModal = openModal;
window.closeModal = closeModal;
window.editData = editData;
window.showImage = showImage;
window.showImages = showImages;
window.switchPreview = switchPreview;
window.closeImage = closeImage;
window.showNoImage = showNoImage;
window.confirmDelete = confirmDelete;