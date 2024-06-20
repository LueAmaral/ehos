<?php
session_start();
include '../assets/php/db.php';
include '../assets/php/functions.php';

verify_session('administrator');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = !empty($_POST['password']) ? $_POST['password'] : null;

    $status = update_user($id, $name, $email, $password);

    if ($status == 'email_exists') {
        $error = "E-mail já cadastrado!";
    } elseif ($status == 'success') {
        $success = "Dados atualizados com sucesso!";
    } else {
        $error = "Erro ao atualizar dados. Tente novamente.";
    }

    // Atualizar os dados do usuário na visualização
    $user = search_users_by_id($id);
} elseif (isset($_GET['id'])) {
    $user = search_users_by_id($_GET['id']);
} else {
    header('Location: dashboard_admin.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" href="../assets/css/style.css">
        <title>Editar Usuário</title>
    </head>

    <body>
        <?php include '../assets/includes/header.php'; ?>

        <div class="container">
            <h2 class="text-center mt-5">Editar Usuário</h2>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>
            <?php if (isset($success)): ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>

            <form action="edit_user.php" method="post" class="mt-4">
                <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <small class="form-text text-muted">Deixe em branco se não quiser mudar a senha.</small>
                </div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
                <button type="button" class="btn btn-secondary" onclick="back()">Voltar</Button>
            </form>
        </div>

        <?php include '../assets/includes/footer.php'; ?>

        <script>
            function back(){
                window.location.href = 'table_admin.php';
            }
        </script>
    </body>
</html>
