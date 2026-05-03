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

                        <div class="text-sm text-gray-500 text-center">
                            © 2026 GudangPro Copyright
                        </div>

                    </div>

                </div>

            </footer>