<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login - StockGudang</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap');

body {
    margin: 0;
    height: 100vh;
    font-family: 'Poppins', sans-serif;
}

/* LAYOUT */
.container-login {
    display: flex;
    height: 100vh;
}

/* LEFT (SAMA KAYAK HOME STYLE) */
.left-side {
    flex: 1;
    background: url("{{ asset('images/gudang.png') }}") center/cover no-repeat;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.left-overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.55);
}

.left-content {
    position: relative;
    text-align: center;
    z-index: 2;
}

.left-content h1 {
    font-size: 42px;
    font-weight: 700;
}

.left-content p {
    font-size: 16px;
    opacity: 0.9;
}

/* RIGHT */
.right-side {
    flex: 1;
    background: linear-gradient(135deg,#1d3557,#457b9d);
    display: flex;
    justify-content: center;
    align-items: center;
}

/* CARD */
.login-card {
    width: 400px;
    background: rgba(255,255,255,0.12);
    backdrop-filter: blur(18px);
    padding: 40px;
    border-radius: 18px;
    color: white;
    box-shadow: 0 10px 40px rgba(0,0,0,0.3);
}

/* TITLE */
.title {
    text-align: center;
    font-weight: 700;
    margin-bottom: 5px;
}

.subtitle {
    text-align: center;
    margin-bottom: 25px;
    opacity: 0.8;
}

/* INPUT */
.input-group {
    margin-bottom: 15px;
}

.input-group-text {
    background: rgba(255,255,255,0.2);
    border: none;
    color: #fff;
}

.form-control {
    background: rgba(255,255,255,0.2);
    border: none;
    color: #fff;
}

.form-control::placeholder {
    color: #eee;
}

.form-control:focus {
    background: rgba(255,255,255,0.3);
    box-shadow: none;
}

/* BUTTON */
.btn-login {
    background: linear-gradient(45deg, #ff7b00, #ff006e);
    border: none;
    border-radius: 10px;
    font-weight: 600;
    transition: 0.3s;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255,0,110,0.5);
}

/* ALERT */
.alert {
    background: rgba(255,0,0,0.2);
    border: none;
    color: white;
}

/* FOOTER */
.footer-text {
    text-align: center;
    margin-top: 15px;
    font-size: 13px;
    opacity: 0.7;
}
</style>
</head>

<body>

<div class="container-login">

    <!-- LEFT -->
    <div class="left-side">
        <div class="left-overlay"></div>
        <div class="left-content">
            <h1>StockGudang</h1>
            <p>Kelola stok gudang dengan cepat & efisien 🚀</p>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="right-side">

        <div class="login-card">

            <h3 class="title">Welcome Back 👋</h3>
            <p class="subtitle">Masuk ke sistem manajemen gudang</p>

            @if(session('error'))
            <div class="alert text-center">
                {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="/login">
            @csrf

            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-user"></i></span>
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>

            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <button class="btn btn-login w-100 mt-2">Login</button>

            </form>

            <div class="footer-text">
                © {{ date('Y') }} StockGudang
            </div>

        </div>

    </div>

</div>

</body>
</html>