<?php
session_start();
include 'db.php';
include 'functions.php';

verify_session('user');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $hashed_password = null;
    }

    if (update_user($id, $name, $email, $hashed_password)) {
        header('Location: ../../views/table_user.php?status=success');
        exit();
    } else {
        header('Location: ../../views/table_user.php?status=error');
        exit();
    }
}
?>