// ==== SESSION TIMEOUT WARNING ==== //
(function () {
    const SESSION_LIFETIME = 480; // menit - samakan dengan SESSION_LIFETIME di .env
    const WARNING_BEFORE   = 5;   // menit sebelum expired, tampilkan warning

    const sessionMs = SESSION_LIFETIME * 60 * 1000;
    const warningMs = WARNING_BEFORE   * 60 * 1000;

    let warningTimer = null;
    let logoutTimer  = null;
    let countdownInterval = null;

    function resetTimers() {
        clearTimeout(warningTimer);
        clearTimeout(logoutTimer);
        clearInterval(countdownInterval);

        // Set timer warning 5 menit sebelum expired
        warningTimer = setTimeout(showWarning, sessionMs - warningMs);

        // Set timer logout otomatis saat expired
        logoutTimer = setTimeout(doLogout, sessionMs);
    }

    function showWarning() {
        let seconds = WARNING_BEFORE * 60;

        Swal.fire({
            icon: 'warning',
            title: 'Session Hampir Berakhir!',
            html: `<p class="text-slate-600 mb-2">Session Anda akan berakhir dalam</p>
                   <p id="swal-countdown" class="text-3xl font-bold text-red-600">${formatTime(seconds)}</p>
                   <p class="text-slate-500 text-sm mt-2">Klik <b>Perpanjang</b> untuk tetap login.</p>`,
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-refresh mr-1"></i> Perpanjang Session',
            cancelButtonText: '<i class="fas fa-sign-out-alt mr-1"></i> Logout Sekarang',
            confirmButtonColor: '#2563eb',
            cancelButtonColor: '#ef4444',
            allowOutsideClick: false,
            allowEscapeKey: false,
            backdrop: 'rgba(15, 23, 42, 0.5) left top no-repeat',
            didOpen: () => {
                // Countdown timer di dalam SweetAlert
                countdownInterval = setInterval(() => {
                    seconds--;
                    const el = document.getElementById('swal-countdown');
                    if (el) el.textContent = formatTime(seconds);
                    if (seconds <= 0) {
                        clearInterval(countdownInterval);
                        Swal.close();
                        doLogout();
                    }
                }, 1000);
            },
            willClose: () => {
                clearInterval(countdownInterval);
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Perpanjang session - hit endpoint ping
                extendSession();
            } else if (result.isDismissed && result.dismiss === Swal.DismissReason.cancel) {
                doLogout();
            }
        });
    }

    function extendSession() {
        fetch('/ping-session', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                'Content-Type': 'application/json',
            }
        })
        .then(res => {
            if (res.ok) {
                resetTimers();
                Swal.fire({
                    icon: 'success',
                    title: 'Session Diperpanjang!',
                    text: 'Anda dapat melanjutkan aktivitas.',
                    timer: 2000,
                    showConfirmButton: false,
                    backdrop: 'rgba(15, 23, 42, 0.4) left top no-repeat',
                });
            } else {
                doLogout();
            }
        })
        .catch(() => doLogout());
    }

    function doLogout() {
        // Submit form logout
        const form = document.getElementById('logoutForm');
        if (form) {
            form.submit();
        } else {
            // Fallback: redirect ke login
            window.location.href = '/login';
        }
    }

    function formatTime(seconds) {
        const m = Math.floor(seconds / 60).toString().padStart(2, '0');
        const s = (seconds % 60).toString().padStart(2, '0');
        return `${m}:${s}`;
    }

    // Reset timer setiap ada aktivitas user
    ['click', 'keypress', 'mousemove', 'scroll', 'touchstart'].forEach(event => {
        document.addEventListener(event, resetTimers, { passive: true });
    });

    // Mulai timer saat halaman load
    resetTimers();

})();