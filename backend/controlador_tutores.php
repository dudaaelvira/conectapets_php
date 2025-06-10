<?php

require_once 'conexao_db.php';

// conexão com o banco de dados a partit do backend
function pegarTodosOsTutores() {
    $pdo = getDbConnection();
    $stmt = $pdo->query("SELECT * FROM tutores");
    // EXECUTE, BUSQUE E ME DEVOLVA O RESULTADO
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

// essa parte é a inserção de dados do cadastro do tutor
function realizarCadastroTutor($nome, $email, $telefone) {
    try {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("INSERT INTO tutores (nome,email,telefone) VALUES (?,?,?)");
        $stmt->execute([$nome, $email, $telefone]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

?>