document.addEventListener("DOMContentLoaded", function () {

    let currentCard = null;

    const items = document.querySelectorAll('.kategori-item');
    const searchInput = document.getElementById('searchKategori');
    const suggestBox = document.getElementById('suggestBox');
    const noResult = document.getElementById('noResult');

    let kategoriList = [];

    // ambil nama kategori
    items.forEach(item => {
        const nama = item.querySelector(".kategori-nama").innerText;
        kategoriList.push(nama);
    });

    // ======================
    // 🔍 SEARCH + SUGGEST
    // ======================
    if (searchInput) {
        searchInput.addEventListener('keyup', function () {

            const keyword = this.value.toLowerCase();
            let visible = 0;

            items.forEach(item => {
                const text = item.innerText.toLowerCase();

                if (text.includes(keyword)) {
                    item.style.display = "block";
                    visible++;
                } else {
                    item.style.display = "none";
                }
            });

            noResult.classList.toggle('hidden', visible !== 0);

            suggestBox.innerHTML = "";

            if (keyword === "") {
                suggestBox.classList.add("hidden");
                return;
            }

            const filtered = kategoriList.filter(k =>
                k.toLowerCase().includes(keyword)
            );

            filtered.slice(0, 5).forEach(item => {
                const div = document.createElement("div");
                div.className = "px-4 py-2 hover:bg-blue-50 cursor-pointer text-sm";
                div.innerText = item;

                div.onclick = () => {
                    searchInput.value = item;
                    suggestBox.classList.add("hidden");
                    searchInput.dispatchEvent(new Event('keyup'));
                };

                suggestBox.appendChild(div);
            });

            suggestBox.classList.remove("hidden");
        });
    }

    // ======================
    // ✏️ EDIT BUTTON
    // ======================
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function () {

            currentCard = this.closest('.kategori-item');

            document.getElementById('editNama').value =
                currentCard.querySelector('.kategori-nama').innerText;

            document.getElementById('editJumlah').value =
                currentCard.querySelector('.kategori-jumlah').innerText.replace(' Barang', '');

            toggleModal(true);
        });
    });

    // ======================
    // 🖼 PREVIEW FOTO
    // ======================
    const inputFoto = document.getElementById('editFoto');

    if (inputFoto) {
        inputFoto.addEventListener('change', function () {

            const file = this.files[0];
            const reader = new FileReader();

            reader.onload = e => {
                const preview = document.getElementById('previewFoto');
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };

            if (file) reader.readAsDataURL(file);
        });
    }

    // ======================
    // 💾 SAVE EDIT
    // ======================
    window.saveEdit = function () {

        const nama = document.getElementById('editNama').value;
        const jumlah = document.getElementById('editJumlah').value;
        const status = document.getElementById('editStatus').value;

        currentCard.querySelector('.kategori-nama').innerText = nama;
        currentCard.querySelector('.kategori-jumlah').innerText = jumlah + " Barang";

        const badge = currentCard.querySelector('.status-badge');
        badge.innerText = status;

        if (status === "Aktif") {
            badge.className = "status-badge absolute bottom-2 left-2 bg-blue-600 text-white text-xs px-2 py-1 rounded-lg";
        } else {
            badge.className = "status-badge absolute bottom-2 left-2 bg-gray-500 text-white text-xs px-2 py-1 rounded-lg";
        }

        const preview = document.getElementById('previewFoto');
        if (preview.src) {
            currentCard.querySelector('.kategori-image').src = preview.src;
        }

        toggleModal(false);
    };

    // ======================
    // 🧊 MODAL CONTROL
    // ======================
    window.toggleModal = function (show) {

        const modal = document.getElementById('modalEdit');
        if (!modal) return;

        modal.classList.toggle('hidden', !show);
        modal.classList.toggle('flex', show);
    };

});