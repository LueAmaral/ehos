<?php
session_start();
include '../assets/php/db.php';
include '../assets/php/functions.php';
verify_session('administrator');

$id = $_GET['id'];
$user = search_users_by_id($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (update_user($id, $name, $email, $password)) {
        header('Location: table_admin.php');
        exit();
    } else {
        $error = "Erro ao atualizar o usuário!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include '../assets/includes/header.php'; ?>
    <div class="container">
        <h2 class="text-center mt-5">Editar Usuário</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form action="edit_user.php?id=<?= $user['id'] ?>" method="post" class="mt-4">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= $user['name'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= $user['email'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha (deixe em branco para não alterar)</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="table_admin.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <?php include '../assets/includes/footer.php'; ?>
</body>
</html>
