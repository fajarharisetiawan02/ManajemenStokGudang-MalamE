<!DOCTYPE html>
<html>
<head>
    <title>Home - Sistem Manajemen Stok Gudang</title>
</head>
<body>

<h1>Selamat Datang di Sistem Manajemen Stok Gudang</h1>

<h2>Data Pengguna</h2>

<p>Nama: {{ $nama }}</p>
<p>Pekerjaan: {{ $pekerjaan }}</p>
<p>Umur: {{ $umur }}</p>
<p>Tanggal Lahir: {{ $tanggal_lahir }}</p>
<p>Tempat Tinggal: {{ $tempat_tinggal }}</p>
<p>Alamat: {{ $alamat }}</p>

<br>

<a href="/login">
<button>Login ke Sistem</button>
</a>

<br><br>

<a href="/contact">Halaman Kontak</a>

</body>
</html>