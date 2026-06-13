<footer class="bg-white border-t border-gray-200">

    <div class="container mx-auto px-8 py-10">

        <div class="flex flex-col md:flex-row justify-between items-center gap-6">

            <!-- Bahasa -->
            @include('components.lang-switcher')

            <div class="text-sm text-gray-500 text-center">
                {{ __('app.copyright') }}
            </div>

        </div>

    </div>

</footer>
