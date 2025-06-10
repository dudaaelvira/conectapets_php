<?php
require_once __DIR__ . "/../backend/controlador_pets.php";
require_once __DIR__ . "/../backend/controlador_tutores.php";

$listaDePets = pegarTodosOsPetsETutores();
$listaDeTutores = pegarTodosOsTutores();

$mensagemDeErro = "";
$mensagemDeSucesso = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["url_foto_pet"])) { //o $_SERVER é uma variável que guarda informações das requisições http sendo feitas
    $nome = $_POST["nome_pet"] ?? null;
    $raca = $_POST["raca_pet"] ?? null;
    $urlFoto = $_POST["url_foto_pet"] ?? null;

    if ($nome && $raca && $urlFoto) {
        if (!filter_var($urlFoto, FILTER_VALIDATE_URL)) {
            $mensagemDeErro = "A url da foto é inválida";
        } elseif (realizarCadastroPet($nome, $raca, $urlFoto)) {
            $mensagemDeSucesso = "Cadastro realizado com sucesso";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            $mensagemDeErro = "Erro ao cadastrar o pet";
        }
    }
}

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["tutor_id"])) {
    $petId = $_POST["pet_id"] ?? null;
    $tutorId = $_POST["tutor_id"] ?? null;

    if($petId && $tutorId) {
        realizarAdocaoPet($petId, $tutorId);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/pagina3_adocao.css">
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
                    <a href="tutores.php" class="estilo-botao-nav">Tutores</a>
                    <a href="relatorios.php" class="estilo-botao-nav">Relatórios</a>
                    <a href="index.php" class="estilo-botao-nav">Sair</a>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <form class="container-cadastro-adocao" method="post">
            <div>
                <span class="titulo-cadastrar">Cadastrar Pet</span>
                <input type="submit" class="queroadotar-laranja" value="Cadastrar">
            </div>
            <div>
                <input type="text" class="input-text" name="nome_pet" placeholder="Nome" required>
                <input type="text" class="input-text" name="raca_pet" placeholder="Raça" required>
                <input type="text" class="input-text" name="url_foto_pet" placeholder="Link da Foto" required>
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
        
        <!--preenche os campos de forma automática com base na lista de pets recuperados do backend que recuperou do banco de dados-->
        <div class="container_opcoespets">
            <?php foreach($listaDePets as $petAtual): ?>
                <div class="coluna">
                    <div class="foto1">
                        <img src="<?= htmlspecialchars($petAtual["pet_url_foto"]) ?>" alt="kika">
                    </div>
                    <div class="informacoespet">
                        <p class="nome"><?= htmlspecialchars($petAtual["pet_nome"]) ?></p>
                        <p>Raça: <?= htmlspecialchars($petAtual["pet_raca"]) ?></p>
                        <p>Tutor: <?= htmlspecialchars($petAtual["tutor_nome"]) ?></p>
                        <p>Email: <?= htmlspecialchars($petAtual["tutor_email"]) ?></p>
                        <p>Telefone: <?= htmlspecialchars($petAtual["tutor_telefone"]) ?></p>
                    </div>
                       <!--faz a condicional para habilitar ou desebilitar o botão da adoção de acordo com a cor-->
                    <?php if($petAtual["tutor_id"] === null): ?>
                        <!-- quanod clicar no modal, vai aparecer o nome do pet, mas o ID fica invisivel, apenas para ser usando no php -->
                        <a href="#" class="queroadotar-laranja" onclick="abrirModal('<?= htmlspecialchars($petAtual['pet_nome']) ?>',<?= $petAtual['pet_id']?>)">Quero adotar</a>
                    <?php else: ?>
                        <a href="#" class="queroadotar-laranja-disabled">Quero adotar</a>
                    <?php endif; ?>
                    
                </div>
            <?php endforeach; ?>    

           
        </div>
    </main>
</body>

<!--representa o modal-->
<div id="id-meu-modal" class="meu-modal">
    <form method="post" class="meu-modal-container">
        <h3>Adoção de Pet</h3>
        <div>
            <strong>Nome do pet: </strong>
            <span id="modal-nome-pet"></span>
        </div>
        <input id="modal-id-pet" name="pet_id" type="hidden">
        <select name="tutor_id" id="modal-select-tutor-id">
            <option value="">Selecione o Tutor...</option>
            <?php foreach ($listaDeTutores as $tutorAtual): ?>
                <option value="<?= $tutorAtual['id'] ?>"><?= htmlspecialchars($tutorAtual['nome']) ?></option>
            <?php endforeach; ?>  
        </select>
        <div>
            <button class="queroadotar-verde">Adotar</button>
            <button class="queroadotar-laranja" onclick="fecharModal()">Cancelar</button>
        </div>
    </form>
</div>

<script>
    //esse getelementbyid é para puxar o id que vai identificar a abertura do modal
    function abrirModal(petNome, petId) {
        document.getElementById("id-meu-modal").classList.add("active");
        document.getElementById("modal-nome-pet").textContent = petNome;
        document.getElementById("modal-id-pet").value = petId;
    }

    function fecharModal() {
        document.getElementById("id-meu-modal").classList.remove("active");
    }
</script>
</html>