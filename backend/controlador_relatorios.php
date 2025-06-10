<?php

require_once 'conexao_db.php';



// conexão com o banco de dados a partit do backend
function pegarAnimaisAdotados() {
    $pdo = getDbConnection();
    $stmt = $pdo->query("SELECT * FROM pets JOIN tutores ON pets.id_tutor=tutores.id WHERE id_tutor IS not NULL");
    // EXECUTE, BUSQUE E ME DEVOLVA O RESULTADO
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}


// conexão com o banco de dados a partit do backend
function pegarAnimaisDisponiveis() {
    $pdo = getDbConnection();
    $stmt = $pdo->query("SELECT * FROM pets WHERE id_tutor IS NULL");
    // EXECUTE, BUSQUE E ME DEVOLVA O RESULTADO
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>