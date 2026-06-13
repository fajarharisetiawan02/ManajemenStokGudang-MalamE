if (document.getElementById('passwordLama')) {

    // === TOGGLE PASSWORD === //
    window.togglePassword = function (inputId, eyeId) {
        const input = document.getElementById(inputId);
        const eye   = document.getElementById(eyeId);
        if (!input || !eye) return;
        if (input.type === 'password') {
            input.type = 'text';
            eye.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            eye.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // === PASSWORD STRENGTH BAR === //
    const passwordBaru = document.getElementById('passwordBaru');
    if (passwordBaru) {
        passwordBaru.addEventListener('input', function () {
            const val  = this.value;
            const bar  = document.getElementById('strengthBar');
            const fill = document.getElementById('strengthFill');
            const text = document.getElementById('strengthText');

            if (!val.length) { bar.classList.add('hidden'); return; }
            bar.classList.remove('hidden');

            let score = 0;
            if (val.length >= 8)           score++;
            if (/[A-Z]/.test(val))         score++;
            if (/[0-9]/.test(val))         score++;
            if (/[^A-Za-z0-9]/.test(val))  score++;

            const levels = [
                { w: '25%',  bg: 'bg-red-500',    label: 'Lemah',  tc: 'text-red-500'    },
                { w: '50%',  bg: 'bg-orange-500', label: 'Cukup',  tc: 'text-orange-500' },
                { w: '75%',  bg: 'bg-yellow-500', label: 'Baik',   tc: 'text-yellow-600' },
                { w: '100%', bg: 'bg-green-500',  label: 'Kuat',   tc: 'text-green-600'  },
            ];
            const lvl        = levels[score - 1] || levels[0];
            fill.style.width = lvl.w;
            fill.className   = `h-full rounded-full transition-all duration-300 ${lvl.bg}`;
            text.textContent = lvl.label;
            text.className   = `text-xs font-medium w-14 text-right ${lvl.tc}`;
        });
    }

}