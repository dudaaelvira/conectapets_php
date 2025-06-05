<?php

require_once 'conexao_db.php';

// essa parte é a verificação do login
function validarLoginAdmin($email, $senha) {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM usuarios WHERE email = ? AND senha = ?");
    $stmt->execute([$email, $senha]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Primeiro, verifica se $result não é nulo
    if ($result !== NULL) {
        // Depois, verifica se o total é maior que 0
        if ($result['total'] > 0) {
            return true;
        }
    }
    return false;
}

// essa parte é a inserção de dados do cadastro
function realizarCadastro($nome, $email, $senha){
    // $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (\"fabio\", \"fabio@gmail.com\", \"123456\");";
    try {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?,?,?)");
        $stmt->execute([$nome, $email, $senha]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

?>