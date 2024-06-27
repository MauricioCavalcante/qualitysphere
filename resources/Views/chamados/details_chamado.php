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




if (isset($_GET['id'])) {
    $id_chamado = $_GET['id'];

    try {
        $conexao = new PDO($dbname, $db_username, $db_password);
        $query = "SELECT * FROM tb_chamados WHERE id_chamado = :id_chamado";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':id_chamado', $id_chamado, PDO::PARAM_INT);
        $stmt->execute();
        $chamado = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$chamado) {
            include("../layouts/header.php");

            echo "<div class='alert alert-danger text-center m-5'>Chamado não encontrado.</div>";
            exit();
        }

        //$audioPath = isset($chamado['caminho_audio']) ? $chamado['caminho_audio'] : null;
    } catch (PDOException $e) {
        echo 'Erro' . $e->getCode() . ' Mensagem:' . $e->getMessage();
        exit();
    }
} else {
    echo "ID do chamado não fornecido.";
    exit();
}

include("../layouts/header.php");

?>

<head>
    <title><?php echo $titulo ?> - Detalhes do Chamado</title>
    <link rel="stylesheet" href="../../../public/css/styles.css">
</head>

<main class="container">
    <h3>Detalhes do Chamado</h3>

    <div class="table-responsive">
        <table class="table table-striped table-sm align-middle text-nowrap">
            <tr>
                <th>ID_Chamado</th>
                <td><?php echo htmlspecialchars($chamado['id_chamado']); ?></td>
            </tr>
            <tr>
                <th>Atendente</th>
                <td><?php echo htmlspecialchars($chamado['id_user']); ?></td>
            </tr>
            <tr>
                <th>Cliente</th>
                <td><?php echo htmlspecialchars($chamado['id_cliente']); ?></td>
            </tr>
            <tr>
                <th>Número do Chamado</th>
                <td><?php echo htmlspecialchars($chamado['num_chamado']); ?></td>
            </tr>
            <tr>
                <th>Título</th>
                <td><?php echo htmlspecialchars($chamado['titulo']); ?></td>
            </tr>
            <tr>
                <th>Áudio</th>
                <td>
                    <!-- TODO: Trazer audio para navegador -->
                    <audio controls>
                        <source src="<?php echo $audioPath; ?>" type="audio/<?php echo pathinfo($audioPath, PATHINFO_EXTENSION); ?>">
                        Seu navegador não suporta o elemento de áudio.
                    </audio>
                </td>
            </tr>
            <tr>
                <th>Transcrição do áudio</th>
                <td><?php echo htmlspecialchars($chamado['transcricao']); ?></td>
            </tr>
            <tr>
                <th>Data de Registro</th>
                <td><?php echo htmlspecialchars($chamado['data_rec']); ?></td>
            </tr>
            <tr>
                <th>Avaliação</th>
                <td><?php echo htmlspecialchars($chamado['avaliacao']); ?></td>
            </tr>
            <tr>
                <th>FeedBack</th>
                <td><?php echo htmlspecialchars($chamado['feedback']); ?></td>
            </tr>
        </table>
    </div>
    <div>
        <button class="btn btn-success">Editar</button>

        <a href="javascript:void(0);" onclick="removerChamado(<?php echo $id_chamado; ?>)" class="btn btn-danger">Excluir</a>

    </div>
</main>

<script src="../../../public/js/scripts.js"></script>