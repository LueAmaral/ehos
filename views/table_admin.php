<?php
session_start();
include '../assets/php/db.php';
include '../assets/php/functions.php';

verify_session('administrator');

$users = search_users();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <title>Dashboard do Administrador</title>
    </head>
    <body>
        <?php include '../assets/includes/header.php'; ?>

        <div class="container">
            <h2 class="text-center mt-5">Dashboard do Administrador</h2>
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td>
                                <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-warning">Editar</a>
                                <a href="../assets/php/delete_user.php?id=<?= $user['id'] ?>" class="btn btn-danger">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php include '../assets/includes/footer.php'; ?>
    </body>
</html>
