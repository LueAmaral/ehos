<?php
session_start();
include '../assets/php/db.php';
include '../assets/php/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $status = signup($name, $email, $password);

    if ($status == 'email_exists') {
        $error = "E-mail já cadastrado!";
    } elseif ($status == 'success') {
        $success = "Cadastro realizado com sucesso!";
    } else {
        $error = "Erro ao realizar cadastro. Tente novamente.";
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
        <title>Cadastro</title>
    </head>

    <body>
        <?php include '../assets/includes/header_sign.php'; ?>

        <div class="container">
            <h2 class="text-center mt-5">Cadastro</h2>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <?php if (isset($success)): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>

            <form action="signup.php" method="post" class="mt-4">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>

        <script src="../assets/js/theme.js"></script>
    </body>
</html>
