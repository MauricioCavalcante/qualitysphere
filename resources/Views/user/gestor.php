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
    <title><?php echo $titulo ?> - Atendentes</title>
    <link rel="stylesheet" href="../../../public/css/styles.css">
    <link rel="stylesheet" href="../../../public/css/usuarios.css">
</head>

<main class="container pagina-usuarios">
    <?php
    if (isset($_GET['remover']) && isset($_GET['remover']) == 1) { ?>
        <div class="ms-auto me-auto d-flex align-items-center justify-content-center alert alert-danger gap-2 w-25" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-diamond" viewBox="0 0 16 16">
                <path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.48 1.48 0 0 1 0-2.098zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z" />
                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
            </svg>
            Usuário deletado!
        </div>
    <?php } ?>
        <h3>Página do Gestor</h3>
    <div class="container-fluid">
        <a class="btn btn-success" href="<?php echo $novo_usuario ?>"><u>Novo Usuário</u></a>
    </div>
    <div class="table-responsive mt-1">
        <table class="table table-striped table-sm">
            <thead>
                <tr class='align-middle text-nowrap '>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Cliente</th>
                    <th>Ramal</th>
                    <th>Pontuação</th>
                    <th colspan="2">Grupo</th>
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
                        echo "<td>
                        <a href='" . $details_usuario . "?id=" . $row['id_user'] . "'>Detalhar
                        </a>
                        </td>";
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