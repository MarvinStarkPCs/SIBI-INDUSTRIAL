<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SIBI - Login</title>

    <!-- Custom fonts for this template -->
    <link href="<?= base_url('assets/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <style>
        body {
            background: url('<?= base_url('img/background.jpg') ?>') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: #2A6322;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .bg-login-image {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .bg-login-image img {
            max-width: 50%;
            height: auto;
            margin: 0 auto;
        }

        .color-button {
            background-color: #FFED00;
        }

        .color-font {
            color: black;
        }

        .title {
            color: #2A6322;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
            font-weight: bold;
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .subtitle {
            color: #333;
            font-size: 1.25rem;
            font-weight: normal;
            font-style: italic;
            margin-bottom: 20px;
        }

        .card.o-hidden.border-0.shadow-lg.my-5 {
            background-color: #EFEFE1;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px; /* Ajusta el margen inferior según sea necesario */
        }

        .caps-lock-warning {
            display: none;
            color: #FFC107;
            font-size: 0.875rem;
            position: absolute;
            bottom: -25px; /* Ajusta este valor si es necesario */
            left: 0;
        }

        .caps-lock-warning.show {
            display: block;
        }

        .show-password-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .caps-lock-active .show-password-icon {
            top: calc(50% + 30px); /* Ajusta este valor según sea necesario */
        }

        /* Ajusta el margen inferior del botón para separarlo de los elementos anteriores */
        button[type="submit"] {
            margin-top: 40px; /* Ajusta el margen superior según sea necesario */
        }
    </style>
</head>

<body>
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            <h1 class="title">SIBI</h1>
                            <p class="subtitle">Sistema de Inventario de Bienes Institucionales</p>
                            <img src="<?= base_url('img/logo colegio.png') ?>" alt="" class="img-fluid">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="color-font h4 mb-4">Bienvenido</h1>
                                </div>

                                <!-- Mostrar errores -->
                                <?php if (session()->getFlashdata('error')): ?>
                                    <div class="alert alert-danger">
                                        <?= session()->getFlashdata('error') ?>
                                    </div>
                                <?php endif; ?>

                                <form class="user" method="post" action="<?= base_url('clogin/authenticate') ?>">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Usuario o Correo">
                                    </div>

                                    <div class="form-group">
                                        <div class="position-relative">
                                            <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Password" onkeydown="checkCapsLock(event)" onkeyup="checkCapsLock(event)" onblur="checkCapsLock(event)">
                                            <div id="caps-lock-warning" class="caps-lock-warning">
                                                <i class="fas fa-exclamation-triangle"></i> ¡Cuidado! Bloq Mayus está activado.
                                            </div>
                                            <i id="togglePassword" class="fas fa-eye show-password-icon" onclick="togglePassword()"></i>
                                        </div>
                                    </div>

                                    <button type="submit" class="color-font btn btn-user btn-block color-button">
                                        Acceder
                                    </button>
                                    <hr>
                                </form>

                                <div class="text-center">
                                    <a class="small color-font" href="forgot-password.html">Olvidaste tu contraseña?</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Core plugin JavaScript -->
<script src="<?= base_url('assets/jquery-easing/jquery.easing.min.js') ?>"></script>

<!-- Custom scripts for all pages -->
<script src="<?= base_url('js/sb-admin-2.min.js') ?>"></script>
<script>
    function checkCapsLock(event) {
        let capsLockWarning = document.getElementById("caps-lock-warning");
        let formGroup = document.querySelector('.form-group');

        if (event.getModifierState("CapsLock")) {
            capsLockWarning.classList.add("show");
            formGroup.classList.add("caps-lock-active");
        } else {
            capsLockWarning.classList.remove("show");
            formGroup.classList.remove("caps-lock-active");
        }
    }

    function togglePassword() {
        const passwordField = document.getElementById("exampleInputPassword");
        const toggleIcon = document.getElementById("togglePassword");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }
</script>
</body>

</html>
