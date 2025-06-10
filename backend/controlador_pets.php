<?php

require_once 'conexao_db.php';

// conexão com o banco de dados a partit do backend
function pegarTodosOsPetsETutores() {
    $pdo = getDbConnection();
    $stmt = $pdo->query("
        SELECT 
            pets.id AS pet_id,
            pets.nome AS pet_nome,
            pets.raca AS pet_raca,
            pets.url_foto AS pet_url_foto,
            tutores.id AS tutor_id,
            tutores.nome AS tutor_nome,
            tutores.telefone AS tutor_telefone,
            tutores.email AS tutor_email
        FROM 
            pets 
        LEFT JOIN 
            tutores ON pets.id_tutor=tutores.id
    ");
    // EXECUTE, BUSQUE E ME DEVOLVA O RESULTADO
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

// essa parte é a inserção de dados do cadastro do pet
function realizarCadastroPet($nome,$raca,$urlFoto) {
    try {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("INSERT INTO pets (nome, raca, url_foto) VALUES (?,?,?)");
        $stmt->execute([$nome,$raca,$urlFoto]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

// esta parte é a adoção do pet. Ela recebe o id do pet e o id do tutor para relacionálos no banco de dados
function realizarAdocaoPet($petId, $tutorId) {
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("UPDATE pets SET id_tutor = ? WHERE id = ?");
    $stmt->execute([$tutorId, $petId]);
}

?>