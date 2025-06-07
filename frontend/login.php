<?php
/**
 * Esta acessando a página do banco de dados, 
 * saindo do frontend com os dois pontinhos, entrando no 
 * backend e acessando a pasta que quero do banco de dados
 */
require_once __DIR__ . "/../backend/controlador_usuarios.php";

$mensagemDeErro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") { //o $_SERVER é uma variável que guarda informações das requisições http sendo feitas
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) { //executa se o email é inválido - pois quero mostrar que ta errado
        $mensagemDeErro = "O e-mail está inválido";
    } 
    elseif(validarLoginAdmin($email, $senha)) { //verifica se o login foi bem sucedido através das informações do banco de dados
        session_start();
        $_SESSION["fez_login"] = $email;
        header("Location: adocao.php"); // link da outra página - é assim no php
        exit; //interromper para ir para outra página

    } else {
        $mensagemDeErro = "O e-mail ou senha inválidos, tente novamente"; //informa que o login falhou
    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pagina2_login.css">
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
                    <a class="pagina-inicial" href="pagina1_principal.html">Pagina Inicial</a>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <div class="background-login">
            <div class="container_2">
                <form class="digitacao" method="post"> <!--medida de segurança para a senha não ficar mostrando na url-->
                    <input class="input-text" type="text" name="email" placeholder="E-mail" required >   <!--name para requisição e required para obrigar a preencher os campos - só funcona no input-->
                    <input class="input-text" type="password" name="senha" placeholder="Senha" required >
                    <input class="login" type="submit" value="Login"> 
                    <?php
                     if($mensagemDeErro !== "") { //Se a mensagem de erro for diferente de vazio, entao existe um erro e ele vai exibir o usuário o erro
                        echo "<p class=\"mensagem-de-erro\" >$mensagemDeErro</p>";
                     }
                    ?>
                    
                    <p>Não possui cadastro? <a href="cadastro.php">Cadastre-se</a></p>
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
</body>
</html>