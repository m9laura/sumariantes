<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        button:focus,
        input:focus,
        textarea:focus {
            outline: 0;
        }

        body {
            background: #181A1B;
            color: #ffffff;
            font-size: 16px;
            line-height: 26px;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
        }

        /* Video de fondo */
        .video-background {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1;
        }

        /* Posicionamiento de logos */
        .logo-top-left {
            position: absolute;
            top: 24px;
            left: 20px;
            width: 100px;
        }

        .logo-center {
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 150px;
        }
        .loginbox {
            margin-top: 23px; /* Ajusta este valor para mover el título más abajo */
        }
        .logo-bottom-left {
            position: absolute;
            bottom: 20px;
            left: 20px;
            width: 120px;
        }
        /* Caja de login */
        .login-box {
            width: 500px;
            margin: 0 auto;
            padding: 150px 0;
            position: relative;
        }

        .login-box h2 {
            font-size: 30px;
            font-weight: 600;
            text-align: center;
            padding-bottom: 45px;
        }

        .login-box input {
            width: 100%;
            height: 50px;
            border: 1px solid #ffffff;
            padding-left: 15px;
            color: #ffffff;
            font-size: 15px;
            font-weight: 500;
            border-radius: 5px;
            background: transparent;
            margin-top: 20px;
        }

        .login-box input::placeholder {
            color: #ffffff;
        }

        .login-box button {
            width: 100%;
            height: 45px;
            border: transparent;
            background: linear-gradient(90deg, #05e8f0 0.1%, #ee0808 98.06%);
            cursor: pointer;
            border-radius: 5px;
            color: #ffffff;
            font-size: 18px;
            font-weight: 500;
            margin-top: 20px;
            transition: .5s;
        }

        .login-box button:hover {
            background: linear-gradient(90deg, #04d2f2 0.1%, #e40303 98.06%);
        }

        /* Animación de los anillos */
        .login-wrap {
            position: relative;
        }

        .login-wrap .ring {
            width: 500px;
            height: 500px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
        }

        .login-wrap .ring i {
            border: 2px solid #ffffff;
            transition: .5s;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .login-wrap:hover .ring i:nth-child(1) {
            border: 6px solid #08d4eb;
            filter: drop-shadow(0 0 20px #04e3d8);
        }

        .login-wrap .ring i:nth-child(1) {
            border-radius: 38% 62% 63% 37% / 41% 44% 56% 59%;
            animation: animate1 6s linear infinite;
        }

        .login-wrap:hover .ring i:nth-child(2) {
            border: 6px solid #f60404;
            filter: drop-shadow(0 0 20px #f20404);
        }

        .login-wrap .ring i:nth-child(2) {
            border-radius: 41% 44% 56% 59% / 38% 62% 63% 37%;
            animation: animate1 6s linear infinite;
        }

        .login-wrap .ring i:nth-child(3) {
            border-radius: 41% 44% 56% / 38% 62% 63% 37%;
            animation: animate2 6s linear infinite;
        }

        .login-wrap:hover .ring i:nth-child(3) {
            border: 6px solid #040404;
            filter: drop-shadow(0 0 20px #0f0f0f);
        }

        @keyframes animate1 {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes animate2 {
            0% {
                transform: rotate(360deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }
    </style>
</head>

<body>
    <!-- Video de fondo -->
    {{-- <video autoplay muted loop class="video-background">
        <source src="/img/video.mp4" type="video/mp4">
        Tu navegador no soporta el elemento de video.
    </video> --}}

    <img src="/img/gamea_logo.png" alt="Logo Superior Izquierdo" class="logo-top-left">
    <img src="/img/also.png" alt="Logo Central" class="logo-center">
    <img src="/img/evi.png" alt="Logo Inferior Izquierdo" class="logo-bottom-left">

    <div class="login-wrap">
        <div class="ring">
            <i></i>
            <i></i>
            <i></i>
        </div>
        <div class="login-box">
            <h2 class="loginbox">SGCCS</h2>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">LOGIN</button>
            </form>
        </div>
    </div>
</body>

</html>
