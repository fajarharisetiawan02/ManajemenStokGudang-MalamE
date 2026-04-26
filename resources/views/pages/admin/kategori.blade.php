@extends('layouts.app')

@section('title', 'Kategori')

@section('icon')
<i class="fas fa-folder text-blue-600"></i>
@endsection

@section('content')

<div class="mb-8 flex justify-between items-center">

    <div class="relative w-64">
        <input id="searchKategori"
               type="text"
               placeholder="Cari kategori..."
               class="w-full pl-11 pr-4 py-2 rounded-xl border border-slate-200 bg-white shadow-sm 
                      focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">

        <i class="fas fa-search absolute left-4 top-3 text-slate-400"></i>

        <div id="suggestBox"
             class="absolute w-full bg-white mt-2 rounded-xl shadow-lg border hidden z-50 max-h-48 overflow-y-auto">
        </div>
    </div>

    <button class="bg-blue-600 text-white px-5 py-2 rounded-xl shadow">
        <i class="fas fa-plus mr-2"></i> Tambah
    </button>

</div>

<div id="kategoriContainer" class="grid md:grid-cols-4 gap-6">

    @foreach($kategori as $item)
    <div class="kategori-item bg-white rounded-2xl shadow hover:shadow-2xl transition group overflow-hidden">

        <div class="h-32 bg-slate-200 relative overflow-hidden">

            <img src="{{ $item->foto ?? asset('images/default.jpg') }}"
                 class="w-full h-full object-cover">

            <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition">
                <div class="bg-white p-2 rounded-lg shadow cursor-pointer editBtn">
                    <i class="fas fa-pen text-blue-500 text-sm"></i>
                </div>
            </div>

            <span class="absolute bottom-2 left-2 bg-blue-600 text-white text-xs px-2 py-1 rounded-lg">
                Aktif
            </span>

        </div>

        <div class="p-5">
            <h3 class="text-lg font-bold text-slate-800 kategori-nama">
                {{ $item->nama }}
            </h3>

            <p class="text-sm text-slate-400 mt-1 kategori-jumlah">
                {{ $item->barang_count }} Barang
            </p>
        </div>

    </div>
    @endforeach

</div>

<div id="noResult" class="hidden text-center mt-10">
    <h2 class="text-xl font-semibold text-slate-600">😕 Tidak ditemukan</h2>
</div>

<!-- MODAL EDIT -->
<div id="modalEdit" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-6 w-96 shadow-xl">

        <h2 class="text-lg font-bold mb-4">Edit Kategori</h2>

        <input type="text" id="editNama" class="w-full mb-3 p-2 border rounded-xl">
        <input type="number" id="editJumlah" class="w-full mb-3 p-2 border rounded-xl">

        <select id="editStatus" class="w-full mb-3 p-2 border rounded-xl">
            <option value="Aktif">Aktif</option>
            <option value="Nonaktif">Nonaktif</option>
        </select>

        <input type="file" id="editFoto" class="mb-3 w-full">

        <img id="previewFoto" class="hidden w-full h-40 object-cover rounded-xl mb-4">

        <div class="flex justify-end gap-3">
            <button onclick="closeModal()" class="px-4 py-2 bg-slate-300 rounded-xl">Batal</button>
            <button onclick="saveEdit()" class="px-4 py-2 bg-blue-600 text-white rounded-xl">Simpan</button>
        </div>

    </div>
</div>


@endsection


@section('script')
<!-- SCRIPT -->
<script>
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

// SEARCH
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

    // suggestion
    suggestBox.innerHTML = "";

    if (keyword === "") {
        suggestBox.classList.add("hidden");
        return;
    }

    const filtered = kategoriList.filter(k =>
        k.toLowerCase().includes(keyword)
    );

    filtered.slice(0,5).forEach(item => {
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

// EDIT BUTTON
document.querySelectorAll('.editBtn').forEach(btn => {
    btn.onclick = function () {

        currentCard = this.closest('.kategori-item');

        document.getElementById('editNama').value =
            currentCard.querySelector('.kategori-nama').innerText;

        document.getElementById('editJumlah').value =
            currentCard.querySelector('.kategori-jumlah').innerText.replace(' Barang','');

        document.getElementById('modalEdit').classList.remove('hidden');
        document.getElementById('modalEdit').classList.add('flex');
    };
});

// PREVIEW FOTO
document.getElementById('editFoto').addEventListener('change', function () {
    const file = this.files[0];
    const reader = new FileReader();

    reader.onload = e => {
        const preview = document.getElementById('previewFoto');
        preview.src = e.target.result;
        preview.classList.remove('hidden');
    };

    if (file) reader.readAsDataURL(file);
});

// SAVE
function saveEdit() {
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

    closeModal();
}

// CLOSE
function closeModal() {
    document.getElementById('modalEdit').classList.add('hidden');
    document.getElementById('modalEdit').classList.remove('flex');
}
</script>

@endsection