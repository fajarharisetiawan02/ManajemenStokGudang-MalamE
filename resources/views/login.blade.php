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

<body class="bg-slate-50 font-sans text-gray-800">

    <!-- NAVBAR -->
    <header class="sticky top-0 z-50 bg-white shadow-sm border-b border-gray-200">
        <div class="container mx-auto px-8 h-20 flex justify-between items-center">

            <div class="flex items-center">
                <img src="{{ asset('images/LogoGudangPro.png') }}" alt="GudangPro Logo"
                    class="h-14 w-auto object-contain brightness-75 contrast-125">
            </div>

        </div>
    </header>

    <!-- CONTENT -->
    <section class="flex-1 px-6 py-4 flex items-center">
        <div
            class="max-w-7xl mx-auto w-full bg-white rounded-3xl shadow-xl overflow-hidden grid lg:grid-cols-2 min-h-[620px]">

            <!-- FORM -->
            <div class="p-8 lg:p-10 flex flex-col justify-center">

                <h2 class="text-5xl font-extrabold text-gray-800 mb-3">
                    Selamat Datang
                </h2>

                <p class="text-gray-500 text-lg mb-8">
                    Masuk untuk mengelola stok gudang Anda.
                </p>

                @if(session('error'))
                <div class="mb-5 bg-red-100 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm">
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

                        <input type="text" name="username" required placeholder="Masukkan username"
                            class="w-full border border-gray-200 rounded-2xl px-5 py-4 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>

                    <!-- PASSWORD -->
                    <div>
                        <label class="text-sm font-semibold text-gray-700 mb-2 block">
                            Password
                        </label>

                        <div class="relative">

                            <input type="password" id="password" name="password" required
                                placeholder="Masukkan password"
                                class="w-full border border-gray-200 rounded-2xl px-5 py-4 pr-14 bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition">

                            <button type="button" onclick="togglePassword()"
                                class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600 transition">
                                       
                            </button>

                        </div>
                    </div>

                    <!-- OPTION -->
                    <div class="flex justify-between items-center text-sm text-gray-500">

                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" class="rounded">
                            Remember me
                        </label>

                        <a href="#" class="text-blue-600 hover:underline">
                            Lupa Password?
                        </a>

                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                        class="w-full py-4 rounded-2xl bg-gradient-to-r from-blue-600 to-blue-500 text-white text-lg font-semibold hover:scale-[1.02] hover:shadow-lg transition duration-300">
                        Masuk
                    </button>

                </form>

            </div>

            <!-- IMAGE -->
            <div class="hidden lg:flex bg-gradient-to-br from-[#eef4ff] to-[#dfeaff] items-center justify-center">

                <img src="{{ asset('images/logingudang.png') }}" class="w-full h-full object-cover">

            </div>

        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-white border-t border-gray-200 mt-auto">

        <div class="container mx-auto px-8 py-12">

            <!-- BOTTOM -->
            <div class="pt-8 flex flex-col md:flex-row justify-between items-center gap-6">

                <!-- LANGUAGE SWITCHER -->
                <div class="relative inline-block group">

                    <!-- BUTTON -->
                    <div
                        class="flex items-center gap-3 px-4 py-2 rounded-xl bg-white border border-gray-200 shadow-sm cursor-pointer hover:shadow-md transition">

                        <!-- Indonesia Flag -->
                        <div class="w-10 h-7 rounded overflow-hidden border border-gray-300">
                            <div class="h-1/2 bg-red-600"></div>
                            <div class="h-1/2 bg-white"></div>
                        </div>

                        <span class="text-lg font-medium text-gray-800">
                            Indonesia
                        </span>

                        <span class="text-gray-400 text-sm transition group-hover:rotate-180">
                               
                        </span>

                    </div>

                    <!-- DROPDOWN -->
                    <div
                        class="absolute left-0 bottom-full mb-3 w-60 bg-white rounded-2xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-200 z-50 overflow-hidden">

                        <!-- English -->
                        <a href="?lang=en" class="flex items-center gap-4 px-5 py-4 hover:bg-blue-50 transition">

                            <div class="w-12 h-8 rounded overflow-hidden border border-gray-300 shadow-sm">
                                <img src="https://flagcdn.com/w40/gb.png" alt="English"
                                    class="w-full h-full object-cover">
                            </div>

                            <div>
                                <p class="text-gray-800 font-medium">English</p>
                                <p class="text-xs text-gray-400">United Kingdom</p>
                            </div>

                        </a>

                        <!-- Indonesia -->
                        <a href="?lang=id"
                            class="flex items-center gap-4 px-5 py-4 bg-gray-50 hover:bg-red-50 transition border-t">

                            <div class="w-12 h-8 rounded overflow-hidden border border-gray-300 shadow-sm">
                                <img src="https://flagcdn.com/w40/id.png" alt="Indonesia"
                                    class="w-full h-full object-cover">
                            </div>

                            <div>
                                <p class="text-red-500 font-medium">Indonesia</p>
                                <p class="text-xs text-gray-400">Bahasa Default</p>
                            </div>

                        </a>

                    </div>

                </div>

                <!-- SOCIAL MEDIA -->
                <div class="flex gap-4">

                    <a href="#"
                        class="w-10 h-10 rounded-md bg-gradient-to-br from-pink-400 via-purple-500 to-yellow-400 shadow flex items-center justify-center hover:scale-110 transition">
                        <i class="fab fa-instagram text-white"></i>
                    </a>

                    <a href="#"
                        class="w-10 h-10 rounded-md bg-sky-500 shadow flex items-center justify-center hover:scale-110 transition">
                        <i class="fab fa-twitter text-white"></i>
                    </a>

                    <a href="#"
                        class="w-10 h-10 rounded-md bg-white border border-gray-200 shadow flex items-center justify-center hover:scale-110 transition">
                        <i class="fab fa-youtube text-red-600"></i>
                    </a>

                    <a href="#"
                        class="w-10 h-10 rounded-md bg-gradient-to-br from-slate-500 to-blue-900 shadow flex items-center justify-center hover:scale-110 transition">
                        <i class="fab fa-facebook-f text-white"></i>
                    </a>

                </div>

                <!-- COPYRIGHT -->
                <div class="text-sm text-gray-500 text-center">
                       2026 GudangPro Copyright
                </div>

            </div>

        </div>

    </footer>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');

            if (password.type === 'password') {
                password.type = 'text';
            } else {
                password.type = 'password';
            }
        }
    </script>

</body>

</html>
