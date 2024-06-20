<?php
/**
 * Função de login do usuário
 * 
 * @param string $email Email do usuário
 * @param string $password Senha do usuário
 * @return bool Retorna true se o login for bem-sucedido, false caso contrário
 */
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

/**
 * Função de registro de novo usuário
 * 
 * @param string $name Nome do usuário
 * @param string $email Email do usuário
 * @param string $password Senha do usuário
 * @return string Retorna 'email_exists' se o e-mail já estiver registrado, 'success' se o registro for bem-sucedido, ou 'error' se ocorrer um erro
 */
function signup($name, $email, $password) {
    $conn = db_connect();

    // Verifica se o e-mail já existe
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        $conn->close();
        return 'email_exists'; // E-mail já existe
    }

    $stmt->close();

    // Insere o novo usuário
    $sql = "INSERT INTO users (name, email, password, type_user) VALUES (?, ?, ?, 'user')";
    $stmt = $conn->prepare($sql);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bind_param('sss', $name, $email, $hashed_password);
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return 'success'; // Usuário criado com sucesso
    }

    $stmt->close();
    $conn->close();
    return 'error'; // Erro ao criar usuário
}

/**
 * Função para verificar a sessão do usuário
 * 
 * @param string $type_user Tipo de usuário esperado (e.g., 'user', 'administrator')
 */
function verify_session($type_user) {
    if (!isset($_SESSION['user_id']) || $_SESSION['type_user'] != $type_user) {
        header('Location: signin.php');
        exit();
    }
}

/**
 * Função para buscar todos os usuários
 * 
 * @return array Lista de usuários
 */
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

/**
 * Função para buscar um usuário pelo ID
 * 
 * @param int $id ID do usuário
 * @return array Dados do usuário
 */
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

/**
 * Função para atualizar os dados de um usuário
 * 
 * @param int $id ID do usuário
 * @param string $name Nome do usuário
 * @param string $email Email do usuário
 * @param string|null $password Senha do usuário (opcional)
 * @return string Retorna 'email_exists' se o e-mail já estiver registrado para outro usuário, 'success' se a atualização for bem-sucedida, ou 'error' se ocorrer um erro
 */
function update_user($id, $name, $email, $password = null) {
    $conn = db_connect();

    // Verifica se o e-mail já existe para outro usuário
    $sql = "SELECT id FROM users WHERE email = ? AND id != ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $email, $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        $conn->close();
        return 'email_exists'; // E-mail já existe
    }

    $stmt->close();

    // Atualiza o usuário
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
        return 'success'; // Usuário atualizado com sucesso
    }

    $stmt->close();
    $conn->close();
    return 'error'; // Erro ao atualizar usuário
}

/**
 * Função para deletar um usuário
 * 
 * @param int $id ID do usuário
 * @return bool Retorna true se o usuário foi deletado com sucesso, false caso contrário
 */
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