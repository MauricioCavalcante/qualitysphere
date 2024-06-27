<?php
session_start();

$request = 'recuperar';

require '../../../routes/views.php';
require '../../../routes/controllers.php';
require '../../../app/Controllers/Config.php';

//validação de login de usuário
if (!isset($_SESSION['user'])) {
    header('Location: ' . $login . '?login=erro2');
}

include("../layouts/header.php");

?>

<head>
    <title>QualitySphere - Novo Chamado</title>
    <link rel="stylesheet" href="../../../public/css/novo_chamado.css">
</head>

<main class="pagina-novo-chamado">
    <?php
    if (isset($_GET['inserir']) && $_GET['inserir'] == 1) { ?>
        <div class="bg-success m-3 p-2 pt-2 rounded-4 text-white d-flex justify-content-center">
            <h5>Chamado registrado com sucesso</h5>
        </div>
    <?php } ?>
    <?php
    if (isset($_GET['inserir']) && $_GET['inserir'] == "tipo_nao_permitido") { ?>
        <div class="bg-warning m-3 p-2 pt-2 rounded-4 text-white d-flex justify-content-center">
            <h5>Arquivo não permitido</h5>
        </div>
    <?php } ?>

    <div class="container-fluid p-5 pt-3">
        <h3>Novo chamado</h3>
        <form class="form-group" action="<?php echo $ChamadoController . '?request=inserir'; ?>" method="post" enctype="multipart/form-data">
            <label for="nome">Nome:</label>
            <input class="form-control" type="text" value="<?php print_r($_SESSION['user']) ?>" name="atendente" disabled readonly>
            <div class="d-flex gap-5 p-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="cliente" id="flexRadioDefault1" value="ANEEL">
                    <label class="form-check-label" for="flexRadioDefault1">
                        ANEEL - NDFANE
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="cliente" id="flexRadioDefault2" value="ANATEL" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        ANATEL - NDFAGA
                    </label>
                </div>
            </div>
            <label for="chamado" class="form-label">Número do Chamado:</label>
            <input class="form-control" type="text" name="num_chamado">
            <label for="titulo" class="form-label">Motivo da ligação:</label>
            <input class="form-control" type="text" name="titulo">
            <label for="audio">Arquivo de Áudio:</label>
            <input type="file" id="audio" name="audio" accept="audio/*"><br><br>
            <button class="btn btn-primary m-3" type="submit">Salvar</button>
        </form>
    </div>
</main>

<script src="../../../public/js/scripts.js"></script>