<?php
    session_start();
    include '../assets/php/db.php';
    include '../assets/php/functions.php';
    verify_session('administrator');

    $id = $_GET['id'];
    if (delete_user($id)) {
        header('Location: table_admin.php');
        exit();
    } else {
        echo "Erro ao deletar o usuário!";
    }
?>