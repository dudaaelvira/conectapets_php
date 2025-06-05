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

?>