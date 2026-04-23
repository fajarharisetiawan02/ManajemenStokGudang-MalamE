<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GudangPro | Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-100 via-blue-50 to-white text-gray-800 flex flex-col">

<!-- NAVBAR -->
<header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md shadow-sm border-b border-gray-200">
    <div class="container mx-auto px-8 h-20 flex justify-between items-center">

        <div class="flex items-center">
            <img src="{{ asset('images/LogoGudangPro.png') }}"
                 class="h-14 w-auto object-contain brightness-75 contrast-125">
        </div>

        <a href="/"
           class="text-blue-600 font-medium hover:underline text-sm">
            Kembali ke Home
        </a>

    </div>
</header>

<!-- CONTENT -->
<section class="flex-1 px-6 py-10 flex items-center">
    <div class="max-w-7xl mx-auto w-full bg-white rounded-3xl shadow-2xl overflow-hidden grid lg:grid-cols-2 min-h-[650px]">

        <!-- FORM -->
        <div class="p-8 lg:p-12 flex flex-col justify-center">

            <div class="mb-8">
                <h2 class="text-5xl font-extrabold text-slate-800 mb-3">
                    Selamat Datang 👋
                </h2>

                <p class="text-gray-500 text-lg">
                    Masuk untuk mengelola stok gudang Anda.
                </p>
            </div>

            @if(session('error'))
            <div class="mb-5 bg-red-100 border border-red-200 text-red-600 px-4 py-3 rounded-2xl text-sm">
                {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="/login" class="space-y-5">
                @csrf

                <!-- USERNAME -->
                <div>
                    <label class="text-sm font-semibold text-gray-700 mb-2 block">
                        Email / Username
                    </label>

                    <input type="text"
                           name="username"
                           required
                           placeholder="Masukkan username"
                           class="w-full border border-gray-200 rounded-2xl px-5 py-4 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </div>

                <!-- PASSWORD -->
                <div>
                    <label class="text-sm font-semibold text-gray-700 mb-2 block">
                        Password
                    </label>

                    <div class="relative">

                        <input type="password"
                               id="password"
                               name="password"
                               required
                               placeholder="Masukkan password"
                               class="w-full border border-gray-200 rounded-2xl px-5 py-4 pr-14 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition">

                        <button type="button"
                                onclick="togglePassword()"
                                class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 transition">

                            <i id="eyeIcon" class="fa-solid fa-eye"></i>

                        </button>

                    </div>
                </div>

                <!-- OPTION -->
                <div class="flex justify-between items-center text-sm text-gray-500">

                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" class="rounded text-blue-600">
                        Remember me
                    </label>

                    <a href="#" class="text-blue-600 hover:underline">
                        Lupa Password?
                    </a>

                </div>

                <!-- BUTTON -->
                <button type="submit"
                        class="w-full py-4 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-lg font-semibold hover:scale-[1.02] hover:shadow-xl transition duration-300">
                    Masuk
                </button>

            </form>

        </div>

        <!-- IMAGE -->
        <div class="hidden lg:flex bg-gradient-to-br from-[#eef4ff] to-[#dfeaff] items-center justify-center relative">

            <img src="{{ asset('images/logingudang.png') }}"
                 class="w-full h-full object-cover">

            <div class="absolute inset-0 bg-white/10"></div>

        </div>

    </div>
</section>

<!-- FOOTER -->
<footer class="bg-white border-t border-gray-200">

    <div class="container mx-auto px-8 py-10">

        <div class="flex flex-col md:flex-row justify-between items-center gap-6">

            <!-- Bahasa -->
            <div class="flex items-center gap-3 px-4 py-2 rounded-xl border border-gray-200 shadow-sm">

                <div class="w-10 h-7 rounded overflow-hidden border">
                    <div class="h-1/2 bg-red-600"></div>
                    <div class="h-1/2 bg-white"></div>
                </div>

                <span class="font-medium text-gray-700">Indonesia</span>

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

<script>
function togglePassword() {
    const password = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    if (password.type === 'password') {
        password.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        password.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
}
</script>

</body>
</html>