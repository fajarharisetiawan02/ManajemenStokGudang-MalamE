document.addEventListener('DOMContentLoaded', function () {

    const appData = document.getElementById('appData');
    if (!appData) return;

    const locale  = appData.dataset.locale;
    const success = appData.dataset.success;
    const error   = appData.dataset.error;
    const warning = appData.dataset.warning;

    // === SESSION ALERTS === //
    if (success) {
        Swal.fire({
            icon: 'success',
            title: locale === 'en' ? 'Success!' : 'Berhasil!',
            text: success,
            confirmButtonColor: '#2563eb',
            backdrop: 'rgba(15, 23, 42, 0.4) left top no-repeat',
        });
    }

    if (error) {
        Swal.fire({
            icon: 'error',
            title: locale === 'en' ? 'Failed!' : 'Gagal!',
            text: error,
            confirmButtonColor: '#ef4444',
            allowOutsideClick: false,
            allowEscapeKey: false,
            backdrop: 'rgba(15, 23, 42, 0.4) left top no-repeat',
        }).then(() => {
            // Buka modal barang lagi kalau error kode duplikat
            if (error.includes('Kode Part') && typeof openModal === 'function') {
                openModal();
            }
        });
    }

    if (warning) {
        Swal.fire({
            icon: 'warning',
            title: locale === 'en' ? 'Warning!' : 'Peringatan!',
            text: warning,
            confirmButtonColor: '#f59e0b',
            backdrop: 'rgba(15, 23, 42, 0.4) left top no-repeat',
        });
    }

    // === CONFIRM DELETE === //
    window.confirmDelete = function (form) {
        Swal.fire({
            title: locale === 'en' ? 'Delete this data?' : 'Yakin hapus data ini?',
            text: locale === 'en' ? 'Deleted data cannot be recovered.' : 'Data yang dihapus tidak bisa dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: locale === 'en' ? 'Yes, delete!' : 'Ya, hapus!',
            cancelButtonText: locale === 'en' ? 'Cancel' : 'Batal',
            backdrop: 'rgba(15, 23, 42, 0.4) left top no-repeat',
        }).then((result) => {
            if (result.isConfirmed) form.submit();
        });
    };

    // === CONFIRM LOGOUT === //
    window.confirmLogout = function () {
        Swal.fire({
            html: `
            <div class="py-2">
                <div class="w-24 h-24 mx-auto rounded-full
                    bg-gradient-to-br from-blue-100 to-blue-200
                    flex items-center justify-center shadow-lg">
                    <i class="fas fa-sign-out-alt text-4xl text-blue-600"></i>
                </div>
                <div class="mt-6">
                    <span class="inline-flex items-center px-3 py-1
                        rounded-full bg-blue-50 text-blue-600 text-xs font-semibold">
                        GudangPro
                    </span>
                    <h2 class="mt-4 text-3xl font-bold text-slate-800">
                        ${locale === 'en' ? 'Sign Out?' : 'Keluar dari Akun?'}
                    </h2>
                    <p class="mt-3 text-slate-500 leading-7 text-sm">
                        ${locale === 'en' ? 'You will be signed out from GudangPro.' : 'Anda akan keluar dari sistem GudangPro.'}
                    </p>
                    <p class="text-slate-500 text-sm">
                        ${locale === 'en' ? 'Make sure all work has been saved before continuing.' : 'Pastikan seluruh pekerjaan telah tersimpan sebelum melanjutkan.'}
                    </p>
                </div>
            </div>`,
            showCancelButton: true,
            allowOutsideClick: false,
            allowEscapeKey: true,
            buttonsStyling: false,
            confirmButtonText: `<i class="fas fa-sign-out-alt mr-2"></i> ${locale === 'en' ? 'Yes, Sign Out' : 'Ya, Keluar'}`,
            cancelButtonText: `<i class="fas fa-times mr-2"></i> ${locale === 'en' ? 'Cancel' : 'Batal'}`,
            reverseButtons: true,
            backdrop: 'rgba(15, 23, 42, 0.4) left top no-repeat',
            customClass: {
                popup:         'rounded-2xl',
                actions:       'gap-4 mt-6',
                confirmButton: '!bg-red-600 hover:!bg-red-700 !text-white !font-semibold !px-6 !py-3 !rounded-xl shadow-lg transition',
                cancelButton:  '!bg-slate-100 hover:!bg-slate-200 !text-slate-700 !font-semibold !px-6 !py-3 !rounded-xl border border-slate-300 transition'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    };

    // === DROPDOWN USER === //
    window.toggleDropdown = function () {
        const menu    = document.getElementById('dropdownProfile');
        const chevron = document.getElementById('dropdownChevron');
        const notif   = document.getElementById('dropdownNotifBox');
        if (!menu) return;
        const isHidden = menu.classList.contains('hidden');
        menu.classList.toggle('hidden', !isHidden);
        if (notif) notif.classList.add('hidden');
        if (chevron) chevron.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0deg)';
    };

    // === DROPDOWN NOTIFIKASI === //
    window.toggleNotif = function () {
        const notif   = document.getElementById('dropdownNotifBox');
        const menu    = document.getElementById('dropdownProfile');
        const chevron = document.getElementById('dropdownChevron');
        if (!notif) return;
        notif.classList.toggle('hidden');
        if (menu) menu.classList.add('hidden');
        if (chevron) chevron.style.transform = 'rotate(0deg)';
    };

    // === TUTUP DROPDOWN KLIK LUAR === //
    document.addEventListener('click', function (e) {
        const userWrapper = document.getElementById('userDropdownWrapper');
        const userMenu    = document.getElementById('dropdownProfile');
        if (userWrapper && userMenu && !userWrapper.contains(e.target)) {
            userMenu.classList.add('hidden');
            const chevron = document.getElementById('dropdownChevron');
            if (chevron) chevron.style.transform = 'rotate(0deg)';
        }
        const notifWrapper = document.getElementById('notifWrapper');
        const notifMenu    = document.getElementById('dropdownNotifBox');
        if (notifWrapper && notifMenu && !notifWrapper.contains(e.target)) {
            notifMenu.classList.add('hidden');
        }
    });

});