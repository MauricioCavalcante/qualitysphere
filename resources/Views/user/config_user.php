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
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
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
    <title><?php echo $titulo ?> - Perfil</title>
    <link rel="stylesheet" href="../../../public/css/styles.css">
</head>

<main class="container">
    <?php
    if (isset($_GET['senha_atualizada']) && isset($_GET['senha_atualizada']) == 1) { ?>
        <div class="ms-auto me-auto d-flex align-items-center justify-content-center alert alert-success gap-2 w-25" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </svg>
            Senha atualizda com sucesso!
        </div>
    <?php } ?>

    <h3>Atendente</h3>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <tr>
                <th>Atendente</th>
                <td><?php echo htmlspecialchars($user['nome']) . ' (' . htmlspecialchars($user['group']) .')'; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
            </tr>
            <tr>
                <th>Cliente</th>
                <td><?php echo htmlspecialchars($user['cliente']); ?></td>
            </tr>
            <tr>
                <th>Ramal</th>
                <td><?php echo htmlspecialchars($user['phone']); ?></td>
            </tr>
            <?php if ($user['group'] == 'ATENDENTE') { ?>
                <tr>
                    <th>Pontuação do Mês</th>
                    <td><?php echo htmlspecialchars($user['score']); ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div>
        <a href="#" class="btn btn-secondary" onclick="alterarSenha()">Alterar senha</a>
    </div>

    <!-- Formulário de alteração de senha -->
    <div class="mt-3 w-50" id="form_senha" style="display: none;">
        <h4>Alterar senha</h4>
        <form action="<?php echo $UserController . '?request=atualizarSenha'; ?>" method="POST" onsubmit="return validarSenha()" class="form-inline">
            <div class="form-group m-2">
                <input type="password" class="form-control" name="senha_atual" placeholder="Senha atual" required>
            </div>
            <div class="form-group m-2">
                <input type="password" class="form-control" name="nova_senha" placeholder="Nova senha" required>
            </div>
            <div class="form-group m-2">
                <input type="password" class="form-control" name="confirmar_nova_senha" onkeyup="validarSenha()" placeholder="Confirmar nova senha" required>
            </div>
            <div class="text-danger" id="mensagemErro"></div>
            <div class="d-flex justify-content-center mb-5 mt-3">
                <button type="submit" class="btn btn-success w-50">Salvar</button>
            </div>
        </form>
    </div>


</main>


<script src="../../../public/js/scripts.js"></script>