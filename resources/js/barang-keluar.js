if (document.getElementById('cekBarang')) {

    // === CEK BARANG === //
    document.getElementById('cekBarang').addEventListener('click', function () {
        const kode = document.getElementById('kode_part').value.trim();
        if (kode === '') {
            Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Masukkan kode part terlebih dahulu' });
            return;
        }
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengecek...';
        this.disabled  = true;

        fetch('/admin/barang-masuk/cek-barang/' + kode)
            .then(res => res.json())
            .then(result => {
                this.innerHTML = '<i class="fas fa-search"></i> Cek Barang';
                this.disabled  = false;

                if (!result.success) {
                    Swal.fire({ icon: 'error', title: 'Gagal', text: 'Kode Part tidak ditemukan' });
                    document.getElementById('infoBarang').classList.add('hidden');
                    return;
                }

                const d    = result.data;
                const stok = d.stok ?? 0;

                document.getElementById('barang_id').value        = d.id;
                document.getElementById('showNama').innerHTML     = d.nama_barang ?? '-';
                document.getElementById('showKategori').innerHTML = d.kategori ?? '-';
                document.getElementById('showBrand').innerHTML    = d.brand ?? '-';
                renderStok(stok, 'showStok');
                showInfoBarang();
            })
            .catch(() => {
                this.innerHTML = '<i class="fas fa-search"></i> Cek Barang';
                this.disabled  = false;
                Swal.fire({ icon: 'error', title: 'Error', text: 'Terjadi kesalahan koneksi' });
            });
    });

    // === HELPER STOK BADGE === //
    window.renderStok = function (stok, elId) {
        let stokClass, stokLabel;
        if (stok <= 0)       { stokClass = 'bg-red-100 text-red-700';       stokLabel = 'Habis';   }
        else if (stok <= 10) { stokClass = 'bg-yellow-100 text-yellow-700'; stokLabel = 'Menipis'; }
        else                 { stokClass = 'bg-green-100 text-green-700';   stokLabel = 'Aman';    }
        document.getElementById(elId).innerHTML =
            `<span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold ${stokClass}">
                <span>${stok}</span><span>|</span><span>${stokLabel}</span>
            </span>`;
    }

    // === ANIMASI INFO BARANG === //
    window.showInfoBarang = function () {
        const box = document.getElementById('infoBarang');
        box.classList.remove('hidden');
        box.style.opacity   = '0';
        box.style.transform = 'translateY(-6px)';
        requestAnimationFrame(() => {
            box.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            box.style.opacity    = '1';
            box.style.transform  = 'translateY(0)';
        });
    }

    // === MODE EDIT === //
    window.setEditMode = function (id, tanggal, jumlah, harga, kode, nama, kategori, brand, stok) {
        document.getElementById('mainForm').action = `/admin/barang-keluar/${id}`;
        document.getElementById('methodContainer').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        document.getElementById('inputTanggal').value = tanggal;
        document.getElementById('inputJumlah').value  = jumlah;
        document.getElementById('inputHarga').value   = harga;
        document.getElementById('kode_part').value    = kode;
        document.getElementById('barang_id').value    = '';
        document.getElementById('showNama').innerHTML     = nama;
        document.getElementById('showKategori').innerHTML = kategori;
        document.getElementById('showBrand').innerHTML    = brand;
        renderStok(stok, 'showStok');
        showInfoBarang();
        document.getElementById('kode_part').readOnly = true;
        document.getElementById('kode_part').classList.add('bg-slate-100', 'cursor-not-allowed');
        document.getElementById('cekBarang').disabled = true;
        document.getElementById('cekBarang').classList.add('opacity-50', 'cursor-not-allowed');
        document.getElementById('formTitle').textContent    = 'Edit Barang Keluar';
        document.getElementById('formSubtitle').textContent = `Sedang mengedit: ${nama} (${kode})`;
        document.getElementById('editBadge').classList.remove('hidden');
        document.getElementById('editBadge').classList.add('flex');
        document.getElementById('btnBatal').classList.remove('hidden');
        document.getElementById('btnBatal').classList.add('flex');
        document.getElementById('btnSubmitText').textContent = 'Simpan Perubahan';
        document.getElementById('btnSubmit').className =
            'px-6 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg shadow-sm transition flex items-center gap-2';
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // === RESET KE MODE TAMBAH === //
    window.resetFormMode = function () {
        const storeUrl = document.getElementById('mainForm').dataset.storeUrl;

        document.getElementById('mainForm').action = storeUrl;
        document.getElementById('mainForm').reset();
        document.getElementById('methodContainer').innerHTML = '';
        document.getElementById('barang_id').value           = '';
        document.getElementById('kode_part').value           = '';
        document.getElementById('infoBarang').classList.add('hidden');
        document.getElementById('kode_part').readOnly = false;
        document.getElementById('kode_part').classList.remove('bg-slate-100', 'cursor-not-allowed');
        document.getElementById('cekBarang').disabled = false;
        document.getElementById('cekBarang').classList.remove('opacity-50', 'cursor-not-allowed');
        document.getElementById('formTitle').textContent    = 'Form Barang Keluar';
        document.getElementById('formSubtitle').textContent = 'Masukkan kode part terlebih dahulu untuk mengecek data barang.';
        document.getElementById('editBadge').classList.add('hidden');
        document.getElementById('editBadge').classList.remove('flex');
        document.getElementById('btnBatal').classList.add('hidden');
        document.getElementById('btnBatal').classList.remove('flex');
        document.getElementById('btnSubmitText').textContent = 'Simpan';
        document.getElementById('btnSubmit').className =
            'px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition flex items-center gap-2';
    }

}