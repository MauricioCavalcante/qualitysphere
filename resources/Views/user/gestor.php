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
    <title>QualitySphere</title>
    <link rel="stylesheet" href="../../../public/css/usuarios.css">
</head>

<main class="container pagina-usuarios">
    <h3>Página do gestor</h3>
    <div class="container-fluid ms-5">
        <a class="btn btn-success" href="<?php echo $novo_usuario ?>"><u>Novo Usuário</u></a>
    </div>
    <div class="table-responsive m-5 mt-1">
        <table class="table table-striped table-sm">
            <thead>
                <tr class='align-middle text-nowrap '>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Cliente</th>
                    <th>Ramal</th>
                    <th>Pontuação</th>
                    <th>Grupo</th>
                </tr>
            </thead>
            <tbody>
                <?php

                try {
                    $conexao = new PDO($dbname, $db_username, $db_password);
                    $query = "SELECT * FROM tb_user";
                    $stmt = $conexao->query($query);
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row) {
                        echo "<tr class='align-middle text-nowrap '>";
                        echo "<td>{$row['nome']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['cliente']}</td>";
                        echo "<td>{$row['phone']}</td>";
                        echo "<td>{$row['score']}</td>";
                        echo "<td>{$row['group']}</td>";

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