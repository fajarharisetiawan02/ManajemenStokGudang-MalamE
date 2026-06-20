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
        document.getElementById('submitKategoriBtnText').innerText = 'Update';
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