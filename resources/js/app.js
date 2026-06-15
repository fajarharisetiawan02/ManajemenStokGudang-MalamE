import './bootstrap';
import '../css/app.css';
import 'flowbite';
import './dashboard';
import './data-barang';
import './detail-barang';
import './kategori';
import './auth';
import './barang-masuk';
import './barang-keluar';
import './supplier';
import './kategori';
import './layout';
import './profil.js';

import Chart from 'chart.js/auto';
window.Chart = Chart;

window.toggleSidebar = function () {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    if (sidebar) sidebar.classList.toggle('-translate-x-full');
    if (overlay) overlay.classList.toggle('hidden');
};