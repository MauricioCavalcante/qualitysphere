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
    <title>QualitySphere - Chamados</title>
    <link rel="stylesheet" href="../../../public/css/styles.css">
</head>

<main class="container">
    <h3>Chamados registrados</h3>
    <?php
    if (isset($_GET['inclusao']) && isset($_GET['inclusao']) == 1) { ?>
        <div class="bg-warning m-3 p-2 pt-2 rounded-4 text-white d-flex justify-content-center">
            <h5>Chamado registrado com sucesso</h5>
        </div>
    <?php } ?>
    <?php
    if (isset($_GET['remover']) && isset($_GET['remover']) == 1) { ?>
        <div class="bg-warning m-3 p-2 pt-2 rounded-4 text-white d-flex justify-content-center">
            <h5>Chamado deletado</h5>
        </div>
    <?php } ?>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr class='align-middle text-nowrap text-center'>
                    <th>Atendente</th>
                    <th>Cliente</th>
                    <th>Número do Chamado</th>
                    <th>Titulo</th>
                    <th>Registro</th>
                    <th>Avaliação</th>

                </tr>
            </thead>

            <tbody>
                <?php

                try {
                    $conexao = new PDO($dbname, $db_username, $db_password);
                    $query = "SELECT * FROM tb_chamados";
                    $stmt = $conexao->query($query);
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row) {
                        echo "<tr class='align-middle text-nowrap text-center' id='chamado-{$row['id_chamado']}'>";
                        echo "<td>{$row['id_user']}</td>";
                        echo "<td>{$row['id_cliente']}</td>";
                        echo "<td><a href='details_chamado.php?id=" . $row['id_chamado'] . "'>{$row['num_chamado']}</a></td>";
                        echo "<td>{$row['titulo']}</td>";
                        echo "<td>{$row['data_rec']}</td>";
                        echo "<td>{$row['avaliacao']}</td>";
                        echo "</tr>";
                    }
                } catch (PDOException $e) {
                    echo 'Erro' . $e->getCode() . ' Mensagem:' . $e->getMessage();
                }



                ?>
            </tbody>
        </table>
    </div>
</main>

<script src="../../../public/js/scripts.js"></script>