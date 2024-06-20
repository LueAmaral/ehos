<?php
function db_connect() {
    $conn = new mysqli('localhost', 'root', '', 'ehos');
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }
    return $conn;
}
?>
