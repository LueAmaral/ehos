<?php
    session_start();
    include 'assets/php/db.php';
    include 'assets/php/functions.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if (signin($email, $senha)) {
            header('Location: ' . ($_SESSION['type_user'] == 'administrator' ? 'table_admin.php' : 'table_user.php'));
            exit();
        } else {
            $error = "Login inválido!";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="assets/svg/ehos_logo.svg" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <title>Ehos</title>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary d-flex align-content-center">
                <div class="container-fluid">
                    <a class="navbar-brand d-flex align-content-center p-0 m-0" href="#">
                        <?php include('assets/svg/ehos_logo.svg'); ?>
                        <p class="m-0 py-0 px-3">Ehos</p>
                    </a>

                    <button class="navbar-toggler rounded-pill" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="navbar-nav me-auto mb-2 mb-lg-0">
                        <!-- Espaçamento no meio -->
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="d-flex">
                        <div id="toggletheme" class="mx-3">
                            <span id="light-mode-icon" style="display: none;">
                            <?php include('assets/svg/light_mode.svg'); ?>
                            </span>
                            <span id="dark-mode-icon">
                            <?php include('assets/svg/dark_mode.svg'); ?>
                            </span>
                        </div>

                        <div class="btn-group" aria-label="Basic example">
                            <button type="button" class="btn btn-secondary rounded-pill mx-2" onclick="signup()">Registrar-se</button>
                            <button type="button" class="btn btn-primary rounded-pill" onclick="signin()">Entrar</button>
                        </div>
                        </div>
                    </div>
                    </div>

                </div>
            </nav>
        </header>


        <script src="assets/js/bootstrap.js"></script>
        <script src="assets/js/theme.js"></script>
        <script>
            function signin(){
                window.location.href = 'views/signin.php';
            }
            function signup(){
                window.location.href = 'views/signup.php';
            }
        </script>

    </body>
</html>