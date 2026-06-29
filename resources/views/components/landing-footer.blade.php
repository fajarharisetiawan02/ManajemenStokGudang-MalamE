<footer class="bg-white border-t border-gray-200 mt-16">

    <div class="container mx-auto px-4 md:px-8 py-12">

        <!-- TOP -->
        <div class="grid grid-cols-1 md:grid-cols-[1.5fr_1fr_1fr_1fr] gap-10 pb-10 border-b border-gray-200">

            <div class="pr-6">
                <h3 class="text-3xl font-bold mb-5">
                    <span class="text-slate-800">Gudang</span><span class="text-blue-700">Pro</span>
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-3">
                    {{ app()->getLocale() === 'en'
                        ? 'A warehouse stock management system for vehicle spare parts, designed to be fast, accurate, and modern.'
                        : 'Sistem manajemen stok gudang spare part kendaraan yang dirancang cepat, akurat, dan modern.' }}
                </p>
                <p class="text-gray-500 text-sm leading-relaxed">
                    {{ app()->getLocale() === 'en'
                        ? 'Developed to simplify automotive spare parts inventory management efficiently.'
                        : 'Dikembangkan untuk memudahkan pengelolaan stok spare part otomotif secara efisien.' }}
                </p>
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
                    {{ app()->getLocale() === 'en' ? 'Contact Us' : 'Hubungi Kami' }}
                </h4>
                <ul class="space-y-3 text-gray-600 text-sm">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-envelope mt-0.5 text-blue-600 flex-shrink-0"></i>
                        <span>info@gudangpro.com</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-map-marker-alt mt-0.5 text-blue-600 flex-shrink-0"></i>
                        <span>Batam, Kepulauan Riau</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-clock mt-0.5 text-blue-600 flex-shrink-0"></i>
                        <span>Senin - Jumat, 08.00 - 17.00</span>
                    </li>
                </ul>
            </div>

        </div>

        <!-- BOTTOM -->
        <div class="pt-8 flex flex-col md:flex-row justify-between items-center gap-6">

            @include('components.lang-switcher')

            <div class="text-sm text-gray-500 text-center">
                {{ __('app.copyright') }}
            </div>

        </div>

    </div>

</footer>