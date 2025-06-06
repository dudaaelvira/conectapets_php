<?php
require_once __DIR__ . "/backend/controlador_usuarios.php";

$mensagemDeErro = "";
$mensagemDeSucesso = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") { //o $_SERVER é uma variável que guarda informações das requisições http sendo feitas
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $confirmarSenha = $_POST["confirmar_senha"];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) { //executa se o email é inválido - pois quero mostrar que ta errado
        $mensagemDeErro = "O e-mail está inválido";
    } 
    elseif($senha !== $confirmarSenha) {
        $mensagemDeErro = "As senhas estão diferentes";
    }
    elseif(realizarCadastro($nome, $email, $senha)) {
        $mensagemDeSucesso = "Cadastro realizado com sucesso";
    }
    else {
        $mensagemDeErro = "E-mail já cadastrado";
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pagina_cadastro.css">
    <title>ConectaPets</title>
</head>

<body>
    <header>
        <div class="container">
            <nav>
                <div class="logo">
                    <a href="index.html">
                        <!--A tag span separa a logo em partes-->
                        <span class="parte1">Conecta</span><span class="parte2">Pets</span>
                    </a>
                </div>
                <div>
                    <a class="login" href="pagina1_principal.html">Pagina Inicial</a>
                    <a class="login" href="login.php">Login</a>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <div class="background-login">
            <div class="container_2">
                <form class="digitacao" method="post"> 
                    <input class="input-text" type="text" name="nome" placeholder="Nome" required>
                    <input class="input-text" type="text" name="email" placeholder="E-mail" required>
                    <input class="input-text" type="password" name="senha" placeholder="Senha" required>
                    <input class="input-text" type="password" name="confirmar_senha" placeholder="Confirmar senha" required>
                    <input class="cadastrar" type="submit" value="Cadastrar">
                    <?php
                     if($mensagemDeErro !== "") { //Se a mensagem de erro for diferente de vazio, entao existe um erro e ele vai exibir o usuário o erro
                        echo "<p class=\"mensagem-de-erro\" >$mensagemDeErro</p>";
                     }
                     if($mensagemDeSucesso !== "") { //Se a mensagem de erro for diferente de vazio, entao existe um erro e ele vai exibir o usuário o erro
                        echo "<p class=\"mensagem-de-sucesso\" >$mensagemDeSucesso</p>";
                     }
                    ?>
                </form>

                <div class="main-img-esquerda">
                    <img src="img/foto_pets_pagina_login-removebg-preview.png" alt="pets">
                </div>
                <div class="main-img-direita">
                    <img src="img/sombra_dog_cat_semfundo.png" alt="pets">
                </div>
            </div>
        </div>
    </main>