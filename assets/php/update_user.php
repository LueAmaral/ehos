<?php
    session_start();
    include 'db.php';
    include 'functions.php';

    // Verifique se a sessão do usuário está ativa
    verify_session('user');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtenha os dados do formulário
        $id = $_SESSION['user_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Verifique se a senha foi fornecida
        if (!empty($password)) {
            // Se a senha foi fornecida, faça o hash dela
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            // Se a senha não foi fornecida, mantenha o valor nulo
            $hashed_password = null;
        }

        // Atualize os dados do usuário
        if (update_user($id, $name, $email, $hashed_password)) {
            // Redirecione para a página do dashboard do usuário com uma mensagem de sucesso
            header('Location: ../../views/table_user.php?status=success');
            exit();
        } else {
            // Redirecione para a página do dashboard do usuário com uma mensagem de erro
            header('Location: ../../views/table_user.php?status=error');
            exit();
        }
    }
?>