if (document.getElementById('mainImage')) {

    window.changeImage = function (button) {
        document.getElementById('mainImage').src = button.dataset.image;

        document.querySelectorAll('.thumb-btn').forEach(item => {
            item.classList.remove('border-blue-500', 'border-2');
            item.classList.add('border-slate-200');
        });

        button.classList.remove('border-slate-200');
        button.classList.add('border-blue-500', 'border-2');
    }

    function matchImageHeight() {
        const detail = document.getElementById('detailKanan');
        const imgContainer = document.getElementById('fotoContainer');
        if (!detail || !imgContainer) return;

        // Hanya samakan tinggi kalau layar xl (1280px) ke atas
        if (window.innerWidth >= 1280) {
            imgContainer.style.height = detail.offsetHeight + 'px';
        } else {
            imgContainer.style.height = 'auto';
        }
    }

    document.addEventListener('DOMContentLoaded', matchImageHeight);
    window.addEventListener('resize', matchImageHeight);

}