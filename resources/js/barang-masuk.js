if (document.getElementById('cekBarang') && document.getElementById('inputSupplier')) {

    // ==== CUSTOM DROPDOWN SUPPLIER ==== //
    function initSupplierDropdown() {
        const select = document.getElementById('inputSupplier');
        if (!select || document.getElementById('inputSupplier_wrapper')) return;

        select.style.display = 'none';

        const wrapper = document.createElement('div');
        wrapper.className = 'relative';
        wrapper.id = 'inputSupplier_wrapper';
        select.parentNode.insertBefore(wrapper, select);
        wrapper.appendChild(select);

        const trigger = document.createElement('button');
        trigger.type = 'button';
        trigger.id = 'inputSupplier_trigger';
        trigger.style.fontFamily = 'inherit';
        trigger.style.fontSize = '14px';
        trigger.style.height = '42px';
        trigger.style.fontWeight = '400';
        trigger.className = 'w-full px-4 border border-slate-300 rounded-lg outline-none bg-white text-left flex items-center justify-between focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition';
        trigger.innerHTML = `<span id="inputSupplier_label" style="color:#94a3b8;">Pilih Supplier</span><svg class="w-4 h-4 text-slate-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>`;
        wrapper.appendChild(trigger);

        const dropdown = document.createElement('div');
        dropdown.id = 'inputSupplier_list';
        dropdown.className = 'bg-white border border-slate-300 rounded-lg shadow-lg';
        dropdown.setAttribute('style', 'position:fixed; z-index:99999; max-height:300px; overflow-y:auto; overflow-x:hidden; font-family:inherit; display:none;');

        Array.from(select.options).forEach((opt) => {
            if (!opt.value) return;
            const item = document.createElement('div');
            item.className = 'px-4 py-2.5 cursor-pointer';
            item.style.fontFamily = 'inherit';
            item.style.fontSize = '14px';
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
                const label = document.getElementById('inputSupplier_label');
                label.textContent = opt.text;
                label.style.color = '#0f172a';
                label.style.fontWeight = '400';
                dropdown.style.display = 'none';
            });
            dropdown.appendChild(item);
        });

        document.body.appendChild(dropdown);

        function updateDropdownPos() {
            const rect = trigger.getBoundingClientRect();
            const navbarHeight = document.getElementById('mainNavbar')?.offsetHeight || 64;
            // Kalau trigger sudah di belakang navbar, tutup dropdown
            if (rect.bottom < navbarHeight) {
                dropdown.style.display = 'none';
                return;
            }
            const viewportWidth = window.innerWidth;
            const dropdownWidth = rect.width;
            let left = rect.left;

            // Pastikan dropdown tidak melebihi layar di kanan
            if (left + dropdownWidth > viewportWidth - 8) {
                left = viewportWidth - dropdownWidth - 8;
            }
            // Pastikan tidak keluar dari kiri layar
            if (left < 8) left = 8;

            dropdown.style.top   = (rect.bottom + 4) + 'px';
            dropdown.style.left  = left + 'px';
            dropdown.style.width = Math.min(dropdownWidth, viewportWidth - 16) + 'px';
        }

        trigger.addEventListener('click', function (e) {
            e.stopPropagation();
            if (dropdown.style.display === 'none' || dropdown.style.display === '') {
                updateDropdownPos();
                dropdown.style.display = 'block';
            } else {
                dropdown.style.display = 'none';
            }
        });

        document.addEventListener('scroll', function () {
            if (dropdown.style.display === 'block') updateDropdownPos();
        }, true);

        document.addEventListener('mousedown', function (e) {
            if (!wrapper.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.style.display = 'none';
            }
        });
    }

    function resetSupplierDropdown() {
        const label = document.getElementById('inputSupplier_label');
        const select = document.getElementById('inputSupplier');
        if (label) { label.textContent = 'Pilih Supplier'; label.style.color = '#94a3b8'; }
        if (select) select.value = '';
    }

    function setSupplierDropdownValue(value) {
        const select = document.getElementById('inputSupplier');
        const label  = document.getElementById('inputSupplier_label');
        if (!select || !label) return;
        select.value = value;
        const opt = Array.from(select.options).find(o => o.value == value);
        if (opt && opt.value) {
            label.textContent = opt.text;
            label.style.color = '#0f172a';
            label.style.fontWeight = '400';
        } else {
            label.textContent = 'Pilih Supplier';
            label.style.color = '#94a3b8';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        initSupplierDropdown();
    });

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
                document.getElementById('showTipe').innerHTML     = d.tipe ?? '-';
                renderStokMasuk(stok, 'showStok');
                showInfoBarangMasuk();
            })
            .catch(() => {
                this.innerHTML = '<i class="fas fa-search"></i> Cek Barang';
                this.disabled  = false;
                Swal.fire({ icon: 'error', title: 'Error', text: 'Terjadi kesalahan koneksi' });
            });
    });

    window.renderStokMasuk = function (stok, elId) {
        let stokClass, stokLabel;
        if (stok <= 0)       { stokClass = 'bg-red-100 text-red-700';       stokLabel = 'Habis';   }
        else if (stok <= 10) { stokClass = 'bg-yellow-100 text-yellow-700'; stokLabel = 'Menipis'; }
        else                 { stokClass = 'bg-green-100 text-green-700';   stokLabel = 'Aman';    }
        document.getElementById(elId).innerHTML =
            `<span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold ${stokClass}">
                <span>${stok}</span><span>|</span><span>${stokLabel}</span>
            </span>`;
    }

    window.showInfoBarangMasuk = function () {
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

    window.setEditModeMasuk = function (id, tanggal, jumlah, harga, supplierId, kode, nama, kategori, brand, stok, tipe) {
        document.getElementById('mainForm').action = `/admin/barang-masuk/${id}`;
        document.getElementById('methodContainer').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        document.getElementById('inputTanggal').value = tanggal;
        document.getElementById('inputJumlah').value  = jumlah;
        document.getElementById('inputHarga').value   = harga;
        setSupplierDropdownValue(supplierId ?? '');
        document.getElementById('kode_part').value    = kode;
        document.getElementById('barang_id').value    = '';
        document.getElementById('showNama').innerHTML     = nama;
        document.getElementById('showKategori').innerHTML = kategori;
        document.getElementById('showBrand').innerHTML    = brand;
        document.getElementById('showTipe').innerHTML     = tipe ?? '-';
        renderStokMasuk(stok, 'showStok');
        showInfoBarangMasuk();
        document.getElementById('kode_part').readOnly = true;
        document.getElementById('kode_part').classList.add('bg-slate-100', 'cursor-not-allowed');
        document.getElementById('cekBarang').disabled = true;
        document.getElementById('cekBarang').classList.add('opacity-50', 'cursor-not-allowed');
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

    window.resetFormMode = function () {
        const storeUrl = document.getElementById('mainForm').dataset.storeUrl;
        document.getElementById('mainForm').action = storeUrl;
        document.getElementById('mainForm').reset();
        document.getElementById('methodContainer').innerHTML = '';
        document.getElementById('barang_id').value = '';
        document.getElementById('kode_part').value = '';
        document.getElementById('infoBarang').classList.add('hidden');
        document.getElementById('kode_part').readOnly = false;
        document.getElementById('kode_part').classList.remove('bg-slate-100', 'cursor-not-allowed');
        document.getElementById('cekBarang').disabled = false;
        document.getElementById('cekBarang').classList.remove('opacity-50', 'cursor-not-allowed');
        document.getElementById('formSubtitle').textContent = 'Masukkan kode part terlebih dahulu untuk mengecek data barang.';
        document.getElementById('editBadge').classList.add('hidden');
        document.getElementById('editBadge').classList.remove('flex');
        document.getElementById('btnBatal').classList.add('hidden');
        document.getElementById('btnBatal').classList.remove('flex');
        document.getElementById('btnSubmitText').textContent = 'Simpan';
        document.getElementById('btnSubmit').className =
            'px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition flex items-center gap-2';
        resetSupplierDropdown();
    }
}