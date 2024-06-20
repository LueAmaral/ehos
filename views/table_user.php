<?php
session_start();
include '../assets/php/db.php';
include '../assets/php/functions.php';

verify_session('user');

$user = search_users_by_id($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <title>Dashboard do Usuário</title>
    </head>
    <body>
        <?php include '../assets/includes/header.php'; ?>

        <div class="container">
            <h2 class="text-center mt-5">Dashboard do Usuário</h2>

            <?php if (isset($_GET['status'])): ?>
                <?php if ($_GET['status'] == 'success'): ?>
                    <div class="alert alert-success">Dados atualizados com sucesso!</div>
                <?php else: ?>
                    <div class="alert alert-danger">Erro ao atualizar os dados.</div>
                <?php endif; ?>
            <?php endif; ?>

            <form action="../assets/php/update_user.php" method="post" class="mt-4">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?= $user['name'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?= $user['email'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <small class="form-text text-muted">Deixe em branco se não quiser mudar a asenha.</small>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </form>
        </div>

        <?php include '../assets/includes/footer.php'; ?>
    </body>
</html>
