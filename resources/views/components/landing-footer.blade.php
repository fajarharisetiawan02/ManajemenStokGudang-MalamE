<footer class="bg-white border-t border-gray-200 mt-16">

    <div class="container mx-auto px-8 py-12">

        <!-- TOP -->
        <div class="grid md:grid-cols-4 gap-10 pb-10 border-b border-gray-200">

            <div>
                <h3 class="text-3xl font-bold text-blue-700 mb-5">
                    GudangPro
                </h3>

                <ul class="space-y-3 text-gray-600 text-sm">
                    <li><a href="#" class="hover:text-blue-600 transition">{{ __('app.pusat_bantuan') }}</a></li>
                    <li><a href="#" class="hover:text-blue-600 transition">FAQ</a></li>
                    <li><a href="/about" class="hover:text-blue-600 transition">{{ __('app.tentang_kami') }}</a></li>
                    <li><a href="#"
                            class="hover:text-blue-600 transition">{{ app()->getLocale() === 'en' ? 'System Guide' : 'Panduan Sistem' }}</a>
                    </li>
                    <li><a href="#"
                            class="hover:text-blue-600 transition">{{ app()->getLocale() === 'en' ? 'Terms & Conditions' : 'Syarat & Ketentuan' }}</a>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="text-2xl font-semibold text-gray-800 mb-5">
                    {{ __('app.tentang_sistem') }}
                </h4>

                <ul class="space-y-3 text-gray-600 text-sm">
                    <li>{{ app()->getLocale() === 'en' ? 'Warehouse Stock Management' : 'Manajemen Stok Gudang' }}</li>
                    <li>{{ app()->getLocale() === 'en' ? 'Vehicle Spare Parts' : 'Spare Part Kendaraan' }}</li>
                    <li>{{ app()->getLocale() === 'en' ? 'Real-Time Monitoring' : 'Monitoring Real-Time' }}</li>
                    <li>{{ app()->getLocale() === 'en' ? 'Automatic Reports' : 'Laporan Otomatis' }}</li>
                </ul>
            </div>

            <div>
                <h4 class="text-2xl font-semibold text-gray-800 mb-5">
                    {{ __('app.keunggulan') }}
                </h4>

                <ul class="space-y-3 text-gray-600 text-sm">
                    <li>{{ app()->getLocale() === 'en' ? 'Easy to Use' : 'Mudah Digunakan' }}</li>
                    <li>{{ app()->getLocale() === 'en' ? 'Multi User Access' : 'Akses Multi User' }}</li>
                    <li>{{ app()->getLocale() === 'en' ? 'More Accurate Data' : 'Data Lebih Akurat' }}</li>
                    <li>{{ app()->getLocale() === 'en' ? 'Efficient & Fast' : 'Efisien & Cepat' }}</li>
                </ul>
            </div>

            <div>
                <h4 class="text-2xl font-semibold text-gray-800 mb-5">
                    {{ __('app.customer_care') }}
                </h4>

                <div class="space-y-4 text-sm text-gray-600">

                    <p><i class="fa-brands fa-whatsapp text-green-500 mr-2"></i>0821-1392-5219</p>
                    <p><i class="fa-solid fa-envelope text-red-500 mr-2"></i>info@gudangpro.com</p>

                    <a href="/contact"
                        class="block text-center bg-blue-700 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition">
                        {{ __('app.hubungi_kami') }}
                    </a>

                </div>

            </div>

        </div>

        <!-- BOTTOM -->
        <div class="pt-8 flex flex-col md:flex-row justify-between items-center gap-6">

            @include('components.lang-switcher')

            <!-- SOCIAL MEDIA -->
            <div class="flex gap-4">

                <a href="#"
                    class="w-10 h-10 rounded-md bg-gradient-to-br from-pink-400 via-purple-500 to-yellow-400 shadow flex items-center justify-center hover:scale-110 transition">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M7 2C4.2 2 2 4.2 2 7v10c0 2.8 2.2 5 5 5h10c2.8 0 5-2.2 5-5V7c0-2.8-2.2-5-5-5H7Zm10 2c1.7 0 3 1.3 3 3v10c0 1.7-1.3 3-3 3H7c-1.7 0-3-1.3-3-3V7c0-1.7 1.3-3 3-3h10Zm-5 3a5 5 0 1 0 0 10 5 5 0 0 0 0-10Zm0 2.2a2.8 2.8 0 1 1 0 5.6 2.8 2.8 0 0 1 0-5.6Zm4.3-.9a1 1 0 1 0 0 2 1 1 0 0 0 0-2Z" />
                    </svg>
                </a>

                <a href="#"
                    class="w-10 h-10 rounded-md bg-sky-500 shadow flex items-center justify-center hover:scale-110 transition">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M22 5.8c-.7.3-1.5.5-2.3.6.8-.5 1.4-1.2 1.7-2.1-.8.5-1.7.8-2.6 1-1.5-1.6-4.2-1.7-5.8-.2-1 1-1.4 2.4-1.1 3.7-3.2-.2-6.1-1.7-8-4.1-1 1.8-.5 4 1.1 5.2-.6 0-1.2-.2-1.7-.5 0 2 1.4 3.8 3.4 4.2-.6.2-1.2.2-1.8.1.5 1.7 2.1 2.9 3.9 2.9A7.8 7.8 0 0 1 2 19.5 11 11 0 0 0 8 21c7.2 0 11.2-6 11.2-11.2v-.5c.8-.5 1.5-1.1 2-1.8Z" />
                    </svg>
                </a>

                <a href="#"
                    class="w-10 h-10 rounded-md bg-white border border-gray-200 shadow flex items-center justify-center hover:scale-110 transition">
                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.4 3.5 12 3.5 12 3.5s-7.4 0-9.4.6A3 3 0 0 0 .5 6.2 31.6 31.6 0 0 0 0 12a31.6 31.6 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c2 .6 9.4.6 9.4.6s7.4 0 9.4-.6a3 3 0 0 0 2.1-2.1A31.6 31.6 0 0 0 24 12a31.6 31.6 0 0 0-.5-5.8ZM10 15.5v-7l6 3.5-6 3.5Z" />
                    </svg>
                </a>

                <a href="#"
                    class="w-10 h-10 rounded-md bg-gradient-to-br from-slate-500 to-blue-900 shadow flex items-center justify-center hover:scale-110 transition">
                    <span class="text-white text-xl font-bold">f</span>
                </a>

            </div>

            <div class="text-sm text-gray-500 text-center">
                {{ __('app.copyright') }}
            </div>

        </div>

    </div>

</footer>
