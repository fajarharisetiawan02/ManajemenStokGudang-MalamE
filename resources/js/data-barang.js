// ==== HELPER: BUAT CUSTOM DROPDOWN ==== //
function createCustomDropdown(selectId, placeholder) {
    const select = document.getElementById(selectId);
    if (!select) return;

    const wrapperId  = selectId + '_wrapper';
    const triggerId  = selectId + '_trigger';
    const labelId    = selectId + '_label';
    const listId     = selectId + '_list';

    if (document.getElementById(wrapperId)) return;

    select.style.display = 'none';

    const wrapper = document.createElement('div');
    wrapper.className = 'relative';
    wrapper.id = wrapperId;
    select.parentNode.insertBefore(wrapper, select);
    wrapper.appendChild(select);

    const trigger = document.createElement('button');
    trigger.type = 'button';
    trigger.id = triggerId;
    trigger.style.fontFamily = 'inherit';
    trigger.style.fontSize = '14px';
    trigger.style.height = '42px';
    trigger.style.fontWeight = '400';
    trigger.className = 'w-full mt-2 px-4 border border-slate-300 rounded-lg outline-none bg-white text-left flex items-center justify-between focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition';
    trigger.innerHTML = `<span id="${labelId}" style="color:#94a3b8;">${placeholder}</span><svg class="w-4 h-4 text-slate-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>`;
    wrapper.appendChild(trigger);

    const dropdown = document.createElement('div');
    dropdown.id = listId;
    dropdown.className = 'absolute z-[99999] w-full bg-white border border-slate-300 rounded-lg shadow-lg mt-1 hidden overflow-y-auto';
    dropdown.style.maxHeight = '200px';
    dropdown.style.fontFamily = 'inherit';

    Array.from(select.options).forEach((opt) => {
        if (!opt.value) return;
        const item = document.createElement('div');
        item.className = 'px-4 py-2.5 cursor-pointer';
        item.style.fontFamily = 'inherit';
        item.style.fontSize = '0.875rem';
        item.style.color = '#0f172a';
        item.textContent = opt.text;
        item.dataset.value = opt.value;

        item.addEventListener('mouseover', function () {
            item.style.backgroundColor = '#0078d4';
            item.style.color = '#ffffff';
        });
        item.addEventListener('mouseout', function () {
            item.style.backgroundColor = '';
            item.style.color = '#0f172a';
        });
        item.addEventListener('click', function () {
            select.value = opt.value;
            const label = document.getElementById(labelId);
            label.textContent = opt.text;
            label.style.color = '#0f172a';
            label.style.fontWeight = '400';
            dropdown.classList.add('hidden');
        });
        dropdown.appendChild(item);
    });

    wrapper.appendChild(dropdown);

    trigger.addEventListener('click', function (e) {
        e.stopPropagation();
        // Tutup semua dropdown lain
        document.querySelectorAll('[id$="_list"]').forEach(function (d) {
            if (d.id !== listId) d.classList.add('hidden');
        });
        dropdown.classList.toggle('hidden');
    });

    document.addEventListener('mousedown', function (e) {
        if (!wrapper.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
}

function resetCustomDropdown(selectId, placeholder) {
    const label = document.getElementById(selectId + '_label');
    const select = document.getElementById(selectId);
    if (label) { label.textContent = placeholder; label.style.color = '#94a3b8'; }
    if (select) select.value = '';
}

function setCustomDropdownValue(selectId, value, placeholder) {
    const select = document.getElementById(selectId);
    const label  = document.getElementById(selectId + '_label');
    if (!select || !label) return;
    select.value = value;
    const opt = Array.from(select.options).find(o => o.value === value);
    if (opt && opt.value) {
        label.textContent = opt.text;
        label.style.color = '#0f172a';
        label.style.fontWeight = '400';
    } else {
        label.textContent = placeholder;
        label.style.color = '#94a3b8';
        label.style.fontWeight = '400';
    }
}

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

    resetCustomDropdown('input_kategori', 'Pilih Kategori');
    resetCustomDropdown('input_brand', 'Pilih Brand');
    resetCustomDropdown('input_tipe', 'Pilih Tipe Kendaraan');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.classList.add('overflow-hidden');
}

// ==== CLOSE MODAL ==== //
function closeModal() {
    const modal = document.getElementById('modalBarang');
    if (!modal) return;
    modal.classList.remove('flex');
    modal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

function editData(button) {
    const modal = document.getElementById('modalBarang');
    const form  = document.getElementById('formBarang');

    form.action = "/admin/data-barang/" + button.dataset.id;
    form.querySelector('input[name="kode"]').value         = button.dataset.noPart || '';
    form.querySelector('input[name="nama_barang"]').value  = button.dataset.namaBarang || '';
    form.querySelector('input[name="harga_jual"]').value   = button.dataset.harga || '';
    form.querySelector('textarea[name="deskripsi"]').value = button.dataset.deskripsi || '';

    setCustomDropdownValue('input_kategori', button.dataset.kategoriId || '', 'Pilih Kategori');
    setCustomDropdownValue('input_brand', button.dataset.brandId || '', 'Pilih Brand');
    setCustomDropdownValue('input_tipe', button.dataset.tipe || '', 'Pilih Tipe Kendaraan');

    document.getElementById('methodContainer').innerHTML = '<input type="hidden" name="_method" value="PUT">';
    document.getElementById('modalTitle').innerText    = 'Edit Barang';
    document.getElementById('modalSubtitle').innerText = 'Perbarui data barang di bawah ini.';
    document.getElementById('submitBtn').innerText     = 'Update';
    document.getElementById('submitBtn').classList.remove('bg-blue-600', 'hover:bg-blue-700');
    document.getElementById('submitBtn').classList.add('bg-amber-500', 'hover:bg-amber-600');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.classList.add('overflow-hidden');
}

// ==== INIT ==== //
document.addEventListener('DOMContentLoaded', function () {
    createCustomDropdown('input_kategori', 'Pilih Kategori');
    createCustomDropdown('input_brand', 'Pilih Brand');
    createCustomDropdown('input_tipe', 'Pilih Tipe Kendaraan');
});

// ==== PREVIEW GAMBAR 1 FOTO ==== //
function showImage(src) {
    const preview      = document.getElementById('previewImage');
    const modal        = document.getElementById('imageModal');
    const thumbGallery = document.getElementById('thumbGallery');
    if (!preview || !modal) return;
    preview.src = src;
    if (thumbGallery) thumbGallery.innerHTML = '';
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

// ==== PREVIEW GAMBAR MULTIPLE ==== //
function showImages(images) {
    const preview      = document.getElementById('previewImage');
    const modal        = document.getElementById('imageModal');
    const thumbGallery = document.getElementById('thumbGallery');
    if (!preview || !modal || !thumbGallery) return;

    let imageList = images;
    if (typeof images === 'string') {
        try { imageList = JSON.parse(images); } catch (e) { imageList = [images]; }
    }
    if (!Array.isArray(imageList)) imageList = [imageList];
    imageList = imageList.filter(Boolean);
    if (imageList.length === 0) { showNoImage(); return; }

    preview.src = imageList[0];
    thumbGallery.innerHTML = '';

    imageList.forEach((src, index) => {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'rounded-xl overflow-hidden border transition duration-200 ' +
            (index === 0 ? 'border-blue-600 ring-2 ring-blue-200' : 'border-gray-200 hover:border-blue-300');
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
    const modal        = document.getElementById('imageModal');
    const thumbGallery = document.getElementById('thumbGallery');
    const preview      = document.getElementById('previewImage');
    if (!modal) return;
    if (thumbGallery) thumbGallery.innerHTML = '';
    if (preview) preview.src = '';
    modal.classList.remove('flex');
    modal.classList.add('hidden');
}

// ==== NO IMAGE ==== //
function showNoImage() {
    Swal.fire({ icon: 'info', title: 'Tidak Ada Gambar', text: 'Produk ini belum memiliki gambar', confirmButtonColor: '#2563eb' });
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
    }).then((result) => { if (result.isConfirmed) form.submit(); });
}

// ==== CLICK OUTSIDE MODAL ==== //
document.addEventListener("click", function (e) {
    const imageModal = document.getElementById('imageModal');
    if (imageModal && e.target === imageModal) closeImage();
});

// ==== ESC CLOSE ==== //
document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") closeImage();
});

// ==== GLOBAL FUNCTION ==== //
window.openModal     = openModal;
window.closeModal    = closeModal;
window.editData      = editData;
window.showImage     = showImage;
window.showImages    = showImages;
window.switchPreview = switchPreview;
window.closeImage    = closeImage;
window.showNoImage   = showNoImage;
window.confirmDelete = confirmDelete;