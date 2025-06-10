<?php
require_once __DIR__ . "/../backend/controlador_relatorios.php";

$relatorioDePets = null;
$tituloRelatorio = "";
$tipo = ""; // disponível ou adotado

if (isset($_GET['acao']) && $_GET['acao'] == 'pets-disponiveis') {
    $relatorioDePets = pegarAnimaisDisponiveis();
    $tituloRelatorio = "Animais Disponíveis";
    $tipo = "disponiveis";
}

if (isset($_GET['acao']) && $_GET['acao'] == 'pets-adotados') {
    $relatorioDePets = pegarAnimaisAdotados();
    $tituloRelatorio = "Animais Adotados";
    $tipo = "adotados";
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pagina5_relatorios.css">
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
                    <a href="tutores.php" class="estilo-botao-nav">Tutores</a>
                    <a href="index.php" class="estilo-botao-nav">Sair</a>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <div class="background-login">
            <div class="container_2">
                <div class="digitacao">
                    <p class="relatorios">Relatórios</p>
                    <a href="?acao=pets-disponiveis" class="disponiveis"> Animais Disponíveis </a>
                    <a href="?acao=pets-adotados" class="adotados"> Animais Adotados </a>
                </div>
            </div>
        </div>

        <div class="background-relatorios">
            <?php if ($relatorioDePets): ?>
                <table>
                    <thead>
                        <tr>
                            <th colspan="<?= $tipo == 'adotados' ? 6 : 4 ?>" style="text-align:center; font-size: 24px; padding: 15px;">
                                <?= $tituloRelatorio ?>
                            </th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Raça</th>
                            <th>Foto</th>
                            <?php if ($tipo == 'adotados'): ?>
                                <th>Email do Tutor</th>
                                <th>Telefone</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($relatorioDePets as $petAtual): ?>
                            <tr>
                                <td><?= htmlspecialchars($petAtual['id']) ?></td>
                                <td><?= htmlspecialchars($petAtual['nome']) ?></td>
                                <td><?= htmlspecialchars($petAtual['raca']) ?></td>
                                <td>
                                    <img src="<?= htmlspecialchars($petAtual['url_foto']) ?>" alt="Foto do pet" style="width:100px; height:auto;">
                                </td>
                                <?php if ($tipo == 'adotados'): ?>
                                    <td><?= htmlspecialchars($petAtual['email']) ?></td>
                                    <td><?= htmlspecialchars($petAtual['telefone']) ?></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="text-align:center;">Nenhum dado disponível.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
