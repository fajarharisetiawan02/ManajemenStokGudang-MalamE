<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Manajemen Stok Gudang') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- NAVBAR -->
    <header class="bg-blue-600 text-white shadow">
        <div class="container mx-auto px-4 py-3 font-semibold">
            Manajemen Stok Gudang
        </div>
    </header>

    <!-- CONTENT -->
    <main class="container mx-auto p-6">
        @yield('content')
    </main>

</body>
</html>