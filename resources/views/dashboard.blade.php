<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>StockGudang Pro</title>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/feather-icons"></script>

</head>

<body class="bg-gray-100">

<div class="flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-slate-900 text-white min-h-screen p-6">
        <h2 class="text-2xl font-bold mb-10">🚗 StockGudang</h2>

        <nav class="space-y-3 text-sm">
            <a class="flex gap-3 p-3 bg-slate-800 rounded-lg"><i data-feather="home"></i>Dashboard</a>
            <a class="flex gap-3 p-3 hover:bg-slate-800 rounded-lg"><i data-feather="box"></i>Sparepart</a>
            <a class="flex gap-3 p-3 hover:bg-slate-800 rounded-lg"><i data-feather="download"></i>Masuk</a>
            <a class="flex gap-3 p-3 hover:bg-slate-800 rounded-lg"><i data-feather="upload"></i>Keluar</a>
        </nav>
    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-6">

        <!-- TOPBAR -->
        <div class="flex justify-between items-center mb-6">

            <h1 class="text-2xl font-bold">Dashboard</h1>

            <div class="flex items-center gap-4">

                <!-- FILTER -->
                <select onchange="setMode(this.value)" class="border px-3 py-2 rounded">
                    <option value="daily">Harian</option>
                    <option value="weekly">Mingguan</option>
                    <option value="monthly">Bulanan</option>
                </select>

                <!-- PROFILE -->
                <div class="relative">
                    <button onclick="toggleDropdown()" class="flex items-center gap-2 bg-white px-3 py-2 rounded-lg shadow hover:bg-gray-50">
                        <img src="A" class="rounded-full w-8 h-8">
                        <span class="text-sm font-medium">Admin</span>
                        <i data-feather="chevron-down"></i>
                    </button>

                    <!-- DROPDOWN -->
                    <div id="dropdownProfile" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow">

                        <a href="/profile" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100">
                            <i data-feather="user"></i> Profile
                        </a>

                        <a href="#" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100">
                            <i data-feather="settings"></i> Settings
                        </a>

                        <hr>

                        <a href="#" class="flex items-center gap-2 px-4 py-2 text-red-500 hover:bg-gray-100">
                            <i data-feather="log-out"></i> Logout
                        </a>

                    </div>
                </div>

            </div>
        </div>

        <!-- CARDS -->
        <div class="grid grid-cols-4 gap-6 mb-6">
            <div class="bg-white p-5 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Total Sparepart</p>
                <h2 class="text-3xl font-bold">144</h2>
            </div>

            <div class="bg-white p-5 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Masuk</p>
                <h2 class="text-3xl font-bold text-green-500">80</h2>
            </div>

            <div class="bg-white p-5 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Keluar</p>
                <h2 class="text-3xl font-bold text-red-500">20</h2>
            </div>

            <div class="bg-white p-5 rounded-xl shadow">
                <p class="text-gray-500 text-sm">Supplier</p>
                <h2 class="text-3xl font-bold text-purple-500">15</h2>
            </div>
        </div>

        <!-- CHART -->
        <div class="bg-white p-6 rounded-xl shadow mb-6">
            <h2 class="font-semibold mb-4">Pergerakan Stok</h2>

            <div class="h-[300px]">
                <canvas id="chart"></canvas>
            </div>

            <!-- DETAIL -->
            <div class="grid grid-cols-2 gap-4 mt-6">

                <div>
                    <h3 class="text-sm font-semibold text-blue-500 mb-2">Barang Masuk</h3>
                    <ul id="listMasuk" class="text-sm space-y-1"></ul>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-red-500 mb-2">Barang Keluar</h3>
                    <ul id="listKeluar" class="text-sm space-y-1"></ul>
                </div>

            </div>
        </div>

    </main>
</div>

<script>
feather.replace();

// DROPDOWN
function toggleDropdown() {
    document.getElementById('dropdownProfile').classList.toggle('hidden');
}

window.addEventListener('click', function(e) {
    if (!e.target.closest('.relative')) {
        document.getElementById('dropdownProfile').classList.add('hidden');
    }
});

// DATA
const dataSet = {
    daily: {
        labels: ['Sen','Sel','Rab','Kam','Jum','Sab','Min'],
        masuk: [10,15,20,30,25,35,40],
        keluar: [5,10,12,20,18,22,30],
        detailMasuk: [['Oli Mesin',30],['Kampas Rem',25],['Filter Udara',10]],
        detailKeluar: [['Ban Mobil',20],['Aki',10],['Busi',5]]
    },
    weekly: {
        labels: ['M1','M2','M3','M4'],
        masuk: [80,120,100,150],
        keluar: [60,90,70,110],
        detailMasuk: [['Oli Mesin',120],['Rem',80],['Filter',60]],
        detailKeluar: [['Ban',90],['Aki',70],['Busi',40]]
    },
    monthly: {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun'],
        masuk: [300,400,350,500,450,600],
        keluar: [250,300,280,400,350,500],
        detailMasuk: [['Oli',500],['Rem',300],['Filter',200]],
        detailKeluar: [['Ban',400],['Aki',250],['Busi',150]]
    }
};

let mode = 'daily';

const chart = new Chart(document.getElementById('chart'), {
    type: 'line',
    data: getData(),
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

function getData() {
    let d = dataSet[mode];
    updateList();

    return {
        labels: d.labels,
        datasets: [
            {
                label: 'Masuk',
                data: d.masuk,
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59,130,246,0.2)',
                fill: true,
                tension: 0.4
            },
            {
                label: 'Keluar',
                data: d.keluar,
                borderColor: '#ef4444',
                backgroundColor: 'rgba(239,68,68,0.2)',
                fill: true,
                tension: 0.4
            }
        ]
    };
}

function setMode(m) {
    mode = m;
    chart.data = getData();
    chart.update();
}

function updateList() {
    let d = dataSet[mode];

    document.getElementById('listMasuk').innerHTML = d.detailMasuk.map(i =>
        `<li class="flex justify-between"><span>${i[0]}</span><span class="text-gray-500">+${i[1]}</span></li>`
    ).join('');

    document.getElementById('listKeluar').innerHTML = d.detailKeluar.map(i =>
        `<li class="flex justify-between"><span>${i[0]}</span><span class="text-gray-500">-${i[1]}</span></li>`
    ).join('');
}

updateList();
</script>

</body>
</html>