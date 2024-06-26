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




if (isset($_SESSION['user'])) {
    $id_user = $_SESSION['user'];

    try {
        $conexao = new PDO($dbname, $db_username, $db_password);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM tb_user WHERE nome = :id_user";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_STR);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            include("../layouts/header.php");

            echo "<div class='alert alert-danger text-center m-5'>Usuário não encontrado.</div>";
            exit();
        }
    } catch (PDOException $e) {
        echo 'Erro' . $e->getCode() . ' Mensagem:' . $e->getMessage();
        exit();
    }
} else {
    echo "Usuário não encontrado.";
    exit();
}

include("../layouts/header.php");

?>

<head>
    <title>Detalhes do Chamado</title>
    <link rel="stylesheet" href="../../../public/css/styles.css">
</head>

<main class="container">
    <h3>Atendente</h3>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <tr>
                <th>Atendente</th>
                <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
            </tr>
            <tr>
                <th>Email</th>
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
                <th>Pontuação do Mês</th>
                <td><?php echo htmlspecialchars($usuario['score']); ?></td>
            </tr>
            <tr>
                <th>Grupo</th>
                <td><?php echo htmlspecialchars($usuario['group']); ?></td>
            </tr>

        </table>
    </div>
    <div>
        <a href="#" class="btn btn-secondary" onclick="alterarSenha()">Alterar senha</a>
    </div>

    <!-- Formulário de alteração de senha -->
    <div class="mt-3 w-25" id="form_senha" style="display: none;">
        <h4>Alterar senha</h4>
        <form action="<?php /* Adicione o action desejado */ ?>" method="POST" class="form-inline">
            <div class="form-group m-2">
                <input type="password" class="form-control" name="senha_atual" placeholder="Senha atual" required>
            </div>
            <div class="form-group m-2">
                <input type="password" class="form-control" name="nova_senha" placeholder="Nova senha" required>
            </div>
            <div class="form-group m-2">
                <input type="password" class="form-control" name="confirmar_nova_senha" placeholder="Confirmar nova senha" required>
            </div>
            <button type="submit" class="btn btn-info">Salvar</button>
        </form>
    </div>


</main>


<script src="../../../public/js/scripts.js"></script>