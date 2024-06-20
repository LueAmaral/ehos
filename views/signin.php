<?php
    session_start();
    include '../assets/php/db.php';
    include '../assets/php/functions.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $password = isset($_POST['password']) ? trim($_POST['password']) : null;

        if ($email && $password) {
            if (signin($email, $password)) {
                header('Location: ' . ($_SESSION['type_user'] == 'administrator' ? 'table_admin.php' : 'table_user.php'));
                exit();
            } else {
                $error = "Login inválido!";
            }
        } else {
            $error = "Por favor, preencha todos os campos!";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <title>Entrar</title>
    </head>
    <body>
        <?php include '../assets/includes/header_sign.php'; ?>
        <div class="container">
            <h2 class="text-center mt-5">Login</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <form action="signin.php" method="post" class="mt-4">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Entrar</button>
                <a href="signup.php" class="btn btn-link">Cadastrar</a>
            </form>
        </div>
        <script src="../assets/js/theme.js"></script>
    </body>
</html>
