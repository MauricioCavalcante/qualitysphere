<?php
session_start();

$request = 'recuperar';

require '../../../routes/controllers.php';
require '../../../routes/views.php';
require '../../../app/Controllers/Config.php';

//validação de login de usuário
if (!isset($_SESSION['user'])) {
    header('Location: ' . $login . '?login=erro2');
}

include("../layouts/header.php");

?>

<head>
    <title>QualitySphere - Meus chamados</title>
    <link rel="stylesheet" href="../../../public/css/styles.css">
</head>

<main class="container">
    <h3>Meus chamados</h3>

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

                    // Consulta baseada no usuário logado
                    $query = "SELECT * FROM tb_chamados WHERE id_user = :id_user";
                    $stmt = $conexao->prepare($query);
                    $stmt->bindParam(':id_user', $_SESSION['user'], PDO::PARAM_STR);
                    $stmt->execute();
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
                    // Exibir a mensagem de erro em caso de falha na consulta
                    echo 'Erro ' . $e->getCode() . ' Mensagem: ' . $e->getMessage();
                }


                ?>
            </tbody>
        </table>
    </div>
</main>