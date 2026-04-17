<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login - StockGudang</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap');

body {
    margin: 0;
    height: 100vh;
    font-family: 'Poppins', sans-serif;
    overflow: hidden;
}

/* ANIMASI BACKGROUND */
.right-side {
    flex: 1;
    background: linear-gradient(270deg, #1d3557, #457b9d, #a8dadc);
    background-size: 600% 600%;
    animation: gradientMove 10s ease infinite;
    display: flex;
    justify-content: center;
    align-items: center;
}

@keyframes gradientMove {
    0% {background-position: 0% 50%;}
    50% {background-position: 100% 50%;}
    100% {background-position: 0% 50%;}
}

/* SPLIT */
.container-login {
    display: flex;
    height: 100vh;
}

/* LEFT */
.left-side {
    flex: 1;
    background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)),
                url("{{ asset('images/gudang.png') }}") center/cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    animation: fadeInLeft 1.2s ease;
}

@keyframes fadeInLeft {
    from {opacity: 0; transform: translateX(-50px);}
    to {opacity: 1; transform: translateX(0);}
}

/* RIGHT */
.right-side {
    animation: fadeInRight 1.2s ease;
}

@keyframes fadeInRight {
    from {opacity: 0; transform: translateX(50px);}
    to {opacity: 1; transform: translateX(0);}
}

/* CARD */
.login-card {
    width: 380px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(15px);
    padding: 35px;
    border-radius: 20px;
    box-shadow: 0 0 30px rgba(255,255,255,0.2);
    color: #fff;

    animation: popUp 0.8s ease;
}

@keyframes popUp {
    from {
        transform: scale(0.8);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

/* HOVER GLOW */
.login-card:hover {
    box-shadow: 0 0 50px rgba(255,255,255,0.4);
    transform: translateY(-5px);
}

/* TEXT */
.title {
    text-align: center;
    font-weight: 700;
    font-size: 26px;
}

.subtitle {
    text-align: center;
    font-size: 13px;
    margin-bottom: 20px;
    opacity: 0.8;
}

/* INPUT */
.form-control {
    border-radius: 10px;
    background: rgba(255,255,255,0.2);
    border: none;
    color: #fff;
    transition: 0.3s;
}

.form-control::placeholder {
    color: #eee;
}

.form-control:focus {
    background: rgba(255,255,255,0.3);
    transform: scale(1.02);
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
    transform: scale(1.08);
    box-shadow: 0 0 15px rgba(255,0,110,0.7);
}

/* LINK */
a {
    color: #ffd166;
}

a:hover {
    text-decoration: underline;
}

/* ALERT */
.alert {
    background: rgba(255,0,0,0.2);
    border: none;
    color: white;
}
</style>
</head>

<body>

<div class="container-login">

    <!-- LEFT -->
    <div class="left-side">
        <div class="text-center">
            <h1>StockGudang</h1>
            <p>Kelola stok lebih modern 🚀</p>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="right-side">

        <div class="login-card">

            <h3 class="title">Login</h3>
            <p class="subtitle">Masuk ke akun kamu</p>

            @if(session('error'))
            <div class="alert">
                {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="/login">
            @csrf

            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <button class="btn btn-login w-100">Login</button>

            </form>

            <div class="text-center mt-3">
                <small>Belum punya akun? <a href="/register">Register</a></small>
            </div>

        </div>

    </div>

</div>

</body>
</html>