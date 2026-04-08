<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login - Sistem Manajemen Stok Gudang</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background: linear-gradient(135deg,#1d3557,#457b9d);
height:100vh;
display:flex;
justify-content:center;
align-items:center;
font-family:Arial;
}

.login-card{
width:400px;
background:white;
padding:35px;
border-radius:12px;
box-shadow:0px 10px 30px rgba(0,0,0,0.2);
}

.title{
text-align:center;
font-weight:bold;
margin-bottom:5px;
}

.subtitle{
text-align:center;
color:gray;
margin-bottom:25px;
font-size:14px;
}

</style>
</head>

<body>

<div class="login-card">

<h3 class="title">LOGIN</h3>
<p class="subtitle">Sistem Manajemen Stok Gudang</p>

@if(session('error'))
<div class="alert alert-danger">
{{ session('error') }}
</div>
@endif

<form method="POST" action="/login">
@csrf

<div class="mb-3">
<label class="form-label">Username</label>
<input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
</div>

<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
</div>

<button class="btn btn-primary w-100">Login</button>

</form>

<br>

<div class="text-center">
<a href="/">Kembali ke Home</a>
</div>

</div>

</body>
</html>