import './bootstrap';
import '../css/app.css';
import 'flowbite';
import './dashboard';
import './modal';
import './kategori';
import './lang';
import './auth';
import './lang-landing';

import Chart from 'chart.js/auto';
window.Chart = Chart;

window.toggleSidebar = function () {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    if (sidebar) sidebar.classList.toggle('-translate-x-full');
    if (overlay) overlay.classList.toggle('hidden');
};