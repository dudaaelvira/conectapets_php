<?php

// funcao para conectar ao banco de dados
function getDbConnection() {
    $host = 'localhost';
    $dbname = 'banco_dados_conecta_pets';
    $user = 'root';
    $pass = '';
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    try {
        return new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    } catch (PDOException $e) {
        die("Erro de conexão: " . $e->getMessage());
    }
}

// pegando os dados da tabela usuarios de dentro do mysql e mostrando na tela
$pdo = getDbConnection();                           // conecta o banco de dados
$stmt = $pdo->prepare("SELECT * FROM usuarios");    // monta o select sql
$stmt->execute();                                   // roda o select
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);        // recupera o conteúdo do select

// printa o contaúdo do resultado na tela
echo '<pre>';
print_r($result);
echo '</pre>';

?>