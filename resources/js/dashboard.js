let fp1;
let fp2;

document.addEventListener("DOMContentLoaded", function () {

    if (!window.Chart) return;

    // ================= DATEPICKER =================
    if (window.flatpickr) {
        fp1 = flatpickr("#rangeTanggal", {
            mode: "range",
            dateFormat: "d/m/Y"
        });

fp2 = flatpickr("#rangeTanggalDonut", {
    mode: "range",
    dateFormat: "d/m/Y",
    appendTo: document.body,   // 🔥 WAJIB
});
    }

    // ================= LINE CHART =================
    const canvas = document.getElementById('stokChart');

    if (canvas) {
        const ctx = canvas.getContext('2d');

        const gradientMasuk = ctx.createLinearGradient(0, 0, 0, 300);
        gradientMasuk.addColorStop(0, "rgba(37,99,235,0.30)");
        gradientMasuk.addColorStop(1, "rgba(37,99,235,0.02)");

        const gradientKeluar = ctx.createLinearGradient(0, 0, 0, 300);
        gradientKeluar.addColorStop(0, "rgba(239,68,68,0.30)");
        gradientKeluar.addColorStop(1, "rgba(239,68,68,0.02)");

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Sen','Sel','Rab','Kam','Jum','Sab','Min'],
                datasets: [
                    {
                        label: 'Barang Masuk',
                        data: [10,15,20,30,25,35,40],
                        borderColor: '#2563eb',
                        backgroundColor: gradientMasuk,
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2,
                        pointRadius: 3,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#2563eb'
                    },
                    {
                        label: 'Barang Keluar',
                        data: [5,10,12,20,18,22,30],
                        borderColor: '#ef4444',
                        backgroundColor: gradientKeluar,
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2,
                        pointRadius: 3,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#ef4444'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });
    }

    // ================= DONUT CHART =================
    const donut = document.getElementById('donutGudang');
    const legend = document.getElementById('legendSupplier');

    if (donut && legend) {

        const labels = ['PT Astra', 'PT Polibatam', 'PT Denso'];
        const data = [300, 450, 250];
        const colors = ['#2563eb', '#60a5fa', '#ef4444'];

        const total = data.reduce((a, b) => a + b, 0);

        new Chart(donut, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: colors,
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: { display: false }
                }
            }
        });

        // LEGEND CUSTOM
        legend.innerHTML = labels.map((label, i) => {
            const value = data[i];
            const percent = ((value / total) * 100).toFixed(1);

            return `
            <div class="flex justify-between items-center hover:translate-x-1 transition">
                <div class="flex items-center gap-2">
                    <span class="w-4 h-4 rounded" style="background:${colors[i]}"></span>
                    <span>${label}</span>
                </div>
                <span class="text-slate-500">${value} (${percent}%)</span>
            </div>
            `;
        }).join('');
    }

});
