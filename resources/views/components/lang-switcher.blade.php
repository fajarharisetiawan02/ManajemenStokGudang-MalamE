<form method="POST" action="{{ route('language.switch') }}" id="langForm">
    @csrf
    <input type="hidden" name="locale" id="localeInput" value="{{ session('locale', 'id') }}">

    <div class="relative inline-block">
        <button type="button" onclick="toggleLangMenu()"
            class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white border border-gray-200 shadow-sm hover:shadow-md transition">

            @if(session('locale', 'id') === 'en')
                <img src="https://flagcdn.com/w40/gb.png" class="w-10 h-7 rounded border border-gray-300 object-cover">
                <span class="text-gray-700 font-medium">English</span>
            @else
                <div class="w-10 h-7 rounded overflow-hidden border border-gray-300">
                    <div class="h-1/2 bg-red-600"></div>
                    <div class="h-1/2 bg-white"></div>
                </div>
                <span class="text-gray-700 font-medium">Indonesia</span>
            @endif

            <span class="text-gray-400 text-sm">▼</span>
        </button>

        <div id="langMenu"
            class="hidden absolute left-0 bottom-full mb-3 w-60 bg-white rounded-2xl shadow-xl border border-gray-100 z-50 overflow-hidden">

            <button type="button" onclick="setLanguage('en')"
                class="w-full flex items-center gap-4 px-5 py-4 hover:bg-blue-50 transition text-left">
                <img src="https://flagcdn.com/w40/gb.png" class="w-12 h-8 rounded border border-gray-300 object-cover">
                <div>
                    <p class="text-gray-800 font-medium">English</p>
                    <p class="text-xs text-gray-400">United Kingdom</p>
                </div>
            </button>

            <button type="button" onclick="setLanguage('id')"
                class="w-full flex items-center gap-4 px-5 py-4 hover:bg-red-50 transition border-t text-left">
                <img src="https://flagcdn.com/w40/id.png" class="w-12 h-8 rounded border border-gray-300 object-cover">
                <div>
                    <p class="text-red-500 font-medium">Indonesia</p>
                    <p class="text-xs text-gray-400">Bahasa Default</p>
                </div>
            </button>

        </div>
    </div>
</form>

<script>
function toggleLangMenu() {
    document.getElementById('langMenu').classList.toggle('hidden');
}
function setLanguage(lang) {
    document.getElementById('localeInput').value = lang;
    document.getElementById('langForm').submit();
}
document.addEventListener('click', function(e) {
    const wrapper = document.getElementById('langForm');
    if (wrapper && !wrapper.contains(e.target)) {
        document.getElementById('langMenu')?.classList.add('hidden');
    }
});
</script>