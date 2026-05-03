<!-- FOOTER -->
    <footer class="bg-white border-t border-gray-200">

        <div class="container mx-auto px-8 py-10">

            <div class="flex flex-col md:flex-row justify-between items-center gap-6">

                <!-- Bahasa -->
                <div class="relative inline-block">

                    <!-- BUTTON -->
                    <button onclick="toggleLangMenu()"
                        class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white border border-gray-200 shadow-sm hover:shadow-md transition">

                        <div class="w-10 h-7 rounded overflow-hidden border border-gray-300" id="langFlag">
                            <div class="h-1/2 bg-red-600"></div>
                            <div class="h-1/2 bg-white"></div>
                        </div>

                        <span id="currentLangText" class="text-gray-700 font-medium">
                            Indonesia
                        </span>

                        <span class="text-gray-400 text-sm">▼</span>
                    </button>

                    <!-- MENU -->
                    <div id="langMenu"
                        class="hidden absolute left-0 bottom-full mb-3 w-60 bg-white rounded-2xl shadow-xl border border-gray-100 z-50 overflow-hidden">

                        <!-- ENGLISH -->
                        <button onclick="setLanguage('en')"
                            class="w-full flex items-center gap-4 px-5 py-4 hover:bg-blue-50 transition text-left">

                            <img src="https://flagcdn.com/w40/gb.png"
                                class="w-12 h-8 rounded border border-gray-300 object-cover">

                            <div>
                                <p class="text-gray-800 font-medium">English</p>
                                <p class="text-xs text-gray-400">United Kingdom</p>
                            </div>

                        </button>

                        <!-- INDONESIA -->
                        <button onclick="setLanguage('id')"
                            class="w-full flex items-center gap-4 px-5 py-4 hover:bg-red-50 transition border-t text-left">

                            <img src="https://flagcdn.com/w40/id.png"
                                class="w-12 h-8 rounded border border-gray-300 object-cover">

                            <div>
                                <p class="text-red-500 font-medium">Indonesia</p>
                                <p class="text-xs text-gray-400">Bahasa Default</p>
                            </div>

                        </button>

                    </div>

                </div>

                <!-- SOCIAL MEDIA -->
                <div class="flex gap-4">

                    <!-- Instagram -->
                    <a href="#"
                        class="w-10 h-10 rounded-md bg-gradient-to-br from-pink-400 via-purple-500 to-yellow-400 shadow flex items-center justify-center hover:scale-110 transition">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7Zm10 2c1.7 0 3 1.3 3 3v10c0 1.7-1.3 3-3 3H7c-1.7 0-3-1.3-3-3V7c0-1.7 1.3-3 3-3h10Zm-5 3a5 5 0 1 0 0 10 5 5 0 0 0 0-10Zm0 2.2a2.8 2.8 0 1 1 0 5.6 2.8 2.8 0 0 1 0-5.6Zm4.3-.9a1 1 0 1 0 0 2 1 1 0 0 0 0-2Z" />
                        </svg>
                    </a>

                    <!-- Twitter -->
                    <a href="#"
                        class="w-10 h-10 rounded-md bg-sky-500 shadow flex items-center justify-center hover:scale-110 transition">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M22 5.8c-.7.3-1.5.5-2.3.6.8-.5 1.4-1.2 1.7-2.1-.8.5-1.7.8-2.6 1-1.5-1.6-4.2-1.7-5.8-.2-1 1-1.4 2.4-1.1 3.7-3.2-.2-6.1-1.7-8-4.1-1 1.8-.5 4 1.1 5.2-.6 0-1.2-.2-1.7-.5 0 2 1.4 3.8 3.4 4.2-.6.2-1.2.2-1.8.1.5 1.7 2.1 2.9 3.9 2.9A7.8 7.8 0 0 1 2 19.5 11 11 0 0 0 8 21c7.2 0 11.2-6 11.2-11.2v-.5c.8-.5 1.5-1.1 2-1.8Z" />
                        </svg>
                    </a>

                    <!-- YouTube -->
                    <a href="#"
                        class="w-10 h-10 rounded-md bg-white border border-gray-200 shadow flex items-center justify-center hover:scale-110 transition">
                        <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.4 3.5 12 3.5 12 3.5s-7.4 0-9.4.6A3 3 0 0 0 .5 6.2 31.6 31.6 0 0 0 0 12a31.6 31.6 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c2 .6 9.4.6 9.4.6s7.4 0 9.4-.6a3 3 0 0 0 2.1-2.1A31.6 31.6 0 0 0 24 12a31.6 31.6 0 0 0-.5-5.8ZM10 15.5v-7l6 3.5-6 3.5Z" />
                        </svg>
                    </a>

                    <!-- Facebook -->
                    <a href="#"
                        class="w-10 h-10 rounded-md bg-gradient-to-br from-slate-500 to-blue-900 shadow flex items-center justify-center hover:scale-110 transition">
                        <span class="text-white text-xl font-bold">f</span>
                    </a>

                </div>

                <!-- Copy -->
                <div class="text-sm text-gray-500 text-center">
                    © 2026 GudangPro Copyright
                </div>

            </div>

        </div>

    </footer>