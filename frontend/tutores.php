<?php
require_once __DIR__ . "/../backend/controlador_tutores.php";

$listaDeTutores = pegarTodosOsTutores();

$mensagemDeErro = "";
$mensagemDeSucesso = "";

function validarTelefone($telefone) {
    if (preg_match('/^\(\d{2}\) \d{5}-\d{4}$/', $telefone)) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['tutor_nome'] ?? null;
    $email = $_POST['tutor_email'] ?? null;
    $telefone = $_POST['tutor_telefone'] ?? null;

    if ($nome && $email && $telefone) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mensagemDeErro = "O e-mail está inválido";
        } elseif(!validarTelefone($telefone)) {
            $mensagemDeErro = "O telefone está inválido. Formato esperado (XX) XXXXX-XXXX";
        } elseif (realizarCadastroTutor($nome, $email, $telefone)) {
            $mensagemDeSucesso = "Cadastro realizado com sucesso";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            $mensagemDeErro = "Erro ao cadastrar o tutor";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pagina4_tutores.css">
    <title>ConectaPets</title>
</head>

<body>
    <header>
        <div class="container">
            <nav>
                <div class="logo">
                    <a href="index.html">
                        <!--A tag span separa a logo em partes-->
                        <span>ConectaPets</span>
                    </a>
                </div>
                <div class="botoes-nav">
                    <a href="adocao.php" class="estilo-botao-nav">Pets</a>
                    <a href="relatorios.php" class="estilo-botao-nav">Relatórios</a>
                    <a href="index.php" class="estilo-botao-nav">Sair</a>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <form class="container-cadastro-adocao" method="post">
            <div>
                <span class="titulo-cadastrar">Cadastrar Tutor</span>
                <input type="submit" class="queroadotar-laranja" value="Cadastrar">
            </div>
            <div>
                <input type="text" class="input-text" name="tutor_nome" placeholder="nome" required>
                <input type="text" class="input-text" name="tutor_email" placeholder="email" required>
                <input type="text" class="input-text" name="tutor_telefone" placeholder="telefone" required>
            </div>
            <?php
            if($mensagemDeErro !== "") { //Se a mensagem de erro for diferente de vazio, entao existe um erro e ele vai exibir o usuário o erro
            echo "<p class=\"mensagem-de-erro\" >$mensagemDeErro</p>";
            }
            if($mensagemDeSucesso !== "") { //Se a mensagem de erro for diferente de vazio, entao existe um erro e ele vai exibir o usuário o erro
            echo "<p class=\"mensagem-de-sucesso\" >$mensagemDeSucesso</p>";
            }
        ?>
        </form>
        
        <!-- TABELA DE USUÁRIOS -->
        <table class="border-style">
        <thead>
            <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaDeTutores as $tutorAtual): ?>
            <tr>
                <td><?= htmlspecialchars($tutorAtual['nome']) ?></td>
                <td><?= htmlspecialchars($tutorAtual['email']) ?></td>
                <td><?= htmlspecialchars($tutorAtual['telefone']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    </main>
</body>
</html>