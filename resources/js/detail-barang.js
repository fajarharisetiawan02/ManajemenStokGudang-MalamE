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

}