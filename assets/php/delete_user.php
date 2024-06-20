<?php
session_start();
include 'db.php';
include 'functions.php';
verify_session('administrator');

$id = $_GET['id'];
if (delete_user($id)) {
    header('Location: ../../views/table_admin.php');
    exit();
} else {
    echo "Erro ao deletar o usuário!";
}
?>