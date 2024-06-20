<?php
function signin($email, $password) {
    $conn = db_connect();
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_regenerate_id(true); // Regerar a sessão para evitar ataques de fixação de sessão
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['type_user'] = $user['type_user'];
            $stmt->close();
            $conn->close();
            return true;
        }
    }
    $stmt->close();
    $conn->close();
    return false;
}

function signup($name, $email, $password) {
    $conn = db_connect();
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (name, email, password, type_user) VALUES (?, ?, ?, 'user')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $name, $email, $hashed_password);
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
    }
    $stmt->close();
    $conn->close();
    return false;
}

function verify_session($type_user) {
    if (!isset($_SESSION['user_id']) || $_SESSION['type_user'] != $type_user) {
        header('Location: signin.php');
        exit();
    }
}

function search_users() {
    $conn = db_connect();
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    $users = [];
    while ($name = $result->fetch_assoc()) {
        $users[] = $name;
    }
    $conn->close();
    return $users;
}

function search_users_by_id($id) {
    $conn = db_connect();
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $name = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $name;
}

function update_user($id, $name, $email, $password = null) {
    $conn = db_connect();
    if ($password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssi', $name, $email, $hashed_password, $id);
    } else {
        $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi', $name, $email, $id);
    }
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
    }
    $stmt->close();
    $conn->close();
    return false;
}

function delete_user($id) {
    $conn = db_connect();
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
    }
    $stmt->close();
    $conn->close();
    return false;
}
?>