<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            margin:0;
            background:#f4f6f9;
        }

        .navbar{
            background:#2c3e50;
            color:white;
            padding:15px;
            font-size:20px;
        }

        .container{
            padding:30px;
        }

        .cards{
            display:flex;
            gap:20px;
            margin-top:20px;
        }

        .card{
            flex:1;
            background:white;
            padding:20px;
            border-radius:10px;
            box-shadow:0 2px 5px rgba(0,0,0,0.1);
            text-align:center;
        }

        .card h2{
            margin:10px 0;
        }

        .btn{
            display:inline-block;
            margin-top:15px;
            padding:10px 15px;
            background:#3498db;
            color:white;
            text-decoration:none;
            border-radius:5px;
        }

        .btn:hover{
            background:#2980b9;
        }
    </style>
</head>

<body>

<div class="navbar">
    Dashboard Aplikasi Manajemen Stok Gudang
</div>

<div class="container">

    <h1>Selamat Datang di Dashboard</h1>
    <p>Ini adalah halaman utama sistem.</p>

    <div class="cards">

        <div class="card">
            <h3>Total Barang</h3>
            <h2>120</h2>
            <p>Jumlah barang yang tersedia</p>
        </div>

        <div class="card">
            <h3>Barang Masuk</h3>
            <h2>45</h2>
            <p>Barang masuk bulan ini</p>
        </div>

        <div class="card">
            <h3>Barang Keluar</h3>
            <h2>30</h2>
            <p>Barang keluar bulan ini</p>
        </div>

    </div>

    <br>

    <a href="/listbarang/1/Laptop" class="btn">Lihat List Barang</a>

</div>

</body>
</html>