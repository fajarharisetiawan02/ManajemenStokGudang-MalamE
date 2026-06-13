document.addEventListener("DOMContentLoaded", function () {

    if (!window.Chart) return;

    // === AMBIL DATA DARI BLADE === //
    const el = document.getElementById('dashboardData');
    if (!el) return;

    const chartLabels = JSON.parse(el.dataset.labels);
    const chartMasuk = JSON.parse(el.dataset.masuk);
    const chartKeluar = JSON.parse(el.dataset.keluar);
    const supplierData = JSON.parse(el.dataset.supplier);

    // === LINE CHART - PERGERAKAN STOK === //
    const canvas = document.getElementById('stokChart');

    if (canvas) {

        const ctx = canvas.getContext('2d');

        const gradientMasuk = ctx.createLinearGradient(0, 0, 0, 350);
        gradientMasuk.addColorStop(0, "rgba(22,163,74,0.15)");
        gradientMasuk.addColorStop(1, "rgba(22,163,74,0.02)");

        const gradientKeluar = ctx.createLinearGradient(0, 0, 0, 350);
        gradientKeluar.addColorStop(0, "rgba(220,38,38,0.12)");
        gradientKeluar.addColorStop(1, "rgba(220,38,38,0.02)");

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [
                    {
                        label: 'Barang Masuk',
                        data: chartMasuk,
                        borderColor: '#16a34a',
                        backgroundColor: gradientMasuk,
                        fill: true,
                        tension: 0.4,
                        cubicInterpolationMode: 'monotone',
                        borderWidth: 2.5,
                        pointRadius: 4,
                        pointHoverRadius: 8,
                        pointBackgroundColor: '#16a34a',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2
                    },
                    {
                        label: 'Barang Keluar',
                        data: chartKeluar,
                        borderColor: '#dc2626',
                        backgroundColor: gradientKeluar,
                        fill: true,
                        tension: 0.4,
                        cubicInterpolationMode: 'monotone',
                        borderWidth: 2.5,
                        pointRadius: 4,
                        pointHoverRadius: 8,
                        pointBackgroundColor: '#dc2626',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2
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

                animation: {
                    duration: 1500,
                    easing: 'easeOutCubic'
                },

                animations: {
                    y: {
                        from: (ctx) => {
                            if (ctx.type === 'data') {
                                return ctx.chart.scales.y.getPixelForValue(0);
                            }
                        },
                        duration: 1500,
                        easing: 'easeOutCubic'
                    }
                },

                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        padding: 12,
                        cornerRadius: 10
                    }
                },

                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    }

    // === DONUT CHART - DISTRIBUSI SUPPLIER === //
    const donut = document.getElementById('donutGudang');
    const legend = document.getElementById('legendSupplier');

    if (donut && legend && supplierData.length > 0) {

        const colors = [
            '#3b82f6',
            '#8b5cf6',
            '#f97316',
            '#10b981',
            '#ef4444',
            '#eab308'
        ];

        const labels = supplierData.map(s => s.nama);
        const data = supplierData.map(s => s.total);
        const total = data.reduce((a, b) => a + b, 0);

        new Chart(donut, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: colors.slice(0, data.length),
                    borderWidth: 2,
                    borderColor: '#fff',
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                cutout: '68%',
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // === CUSTOM LEGEND === //
        legend.innerHTML = labels.map((label, i) => {

            const pct = total > 0
                ? ((data[i] / total) * 100).toFixed(1)
                : 0;

            return `
                <div class="flex items-center justify-between gap-2">
                    <div class="flex items-center gap-2">
                        <span
                            class="w-3 h-3 rounded-full flex-shrink-0"
                            style="background:${colors[i]}">
                        </span>
                        <span class="text-slate-700 text-xs">
                            ${label}
                        </span>
                    </div>
                    <span class="text-xs text-slate-500 font-medium whitespace-nowrap">
                        ${data[i].toLocaleString()} (${pct}%)
                    </span>
                </div>
            `;

        }).join('');
    }

});