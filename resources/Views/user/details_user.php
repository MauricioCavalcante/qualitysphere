<?php
session_start();

$request = 'recuperar';

require '../../../routes/views.php';
require '../../../routes/controllers.php';
require '../../../app/Controllers/Config.php';

// Validação de login de usuário
if (!isset($_SESSION['user'])) {
    header('Location: ' . $login . '?login=erro2');
    exit();
}

if (isset($_GET['id'])) {
    $id_user = $_GET['id'];

    try {
        $conexao = new PDO($dbname, $db_username, $db_password);
        $query = "SELECT * FROM tb_user WHERE id_user = :id_user";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            include("../layouts/header.php");
            echo "<div class='alert alert-danger text-center m-5'>Usuário não encontrado.</div>";
            exit();
        }
    } catch (PDOException $e) {
        echo 'Erro ' . $e->getCode() . ' Mensagem: ' . $e->getMessage();
        exit();
    }
} else {
    echo "ID do usuário não fornecido.";
    exit();
}

include("../layouts/header.php");
?>

<head>
    <title><?php echo htmlspecialchars($titulo); ?> - Usuário</title>
    <link rel="stylesheet" href="../../../public/css/styles.css">
</head>

<main class="container">
    <h3><?php echo htmlspecialchars($usuario['nome']); ?></h3>


    <div class="table-responsive">
        <table class="table table-striped table-sm align-middle text-nowrap">
            <tr>
                <th>ID_Usuário</th>
                <td><?php echo htmlspecialchars($usuario['id_user']); ?></td>
            </tr>
            <tr>
                <th>Nome de usuário</th>
                <td><?php echo htmlspecialchars($usuario['username']); ?></td>
            </tr>
            <tr>
                <th>E-mail</th>
                <td><?php echo htmlspecialchars($usuario['email']); ?></td>
            </tr>
            <tr>
                <th>Cliente</th>
                <td><?php echo htmlspecialchars($usuario['cliente']); ?></td>
            </tr>
            <tr>
                <th>Ramal</th>
                <td><?php echo htmlspecialchars($usuario['phone']); ?></td>
            </tr>
            <tr>
                <th>Data de Registro</th>
                <td><?php echo htmlspecialchars($usuario['data_rec']); ?></td>
            </tr>
        </table>
    </div>
    <div>
        <button class="btn btn-success">Editar</button>
        <a href="javascript:void(0);" onclick="removerUser(<?php echo $_GET['id'] ?>)" class="btn btn-danger">Excluir Usuário</a>
    </div>
    <div class="table-responsive mt-5">
        <h4>Histórico de chamados</h4>
        <table class="table table-striped table-sm">
            <thead>
                <tr class='align-middle text-nowrap text-center'>
                    <th>Atendente</th>
                    <th>Cliente</th>
                    <th>Número do Chamado</th>
                    <th>Título</th>
                    <th>Registro</th>
                    <th>Avaliação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    $query = "SELECT * FROM tb_chamados WHERE id_user = :atendente";
                    $stmt = $conexao->prepare($query);
                    $stmt->bindParam(':atendente', $usuario['nome'], PDO::PARAM_STR);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($result as $row) {
                        echo "<tr class='align-middle text-nowrap text-center' id='chamado-{$row['id_chamado']}'>";
                        echo "<td>" . htmlspecialchars($row['id_user']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['id_cliente']) . "</td>";
                        echo '<td><a href="' . htmlspecialchars($details_chamado . '?id=' . $row['id_chamado']) . '">' . htmlspecialchars($row['num_chamado']) . '</a></td>';
                        echo "<td>" . htmlspecialchars($row['titulo']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['data_rec']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['avaliacao']) . "</td>";
                        echo "</tr>";
                    }
                } catch (PDOException $e) {
                    echo 'Erro ' . $e->getCode() . ' Mensagem: ' . $e->getMessage();
                }
                ?>
            </tbody>
        </table>
    </div>
</main>

<script src="../../../public/js//scripts.js"></script>
