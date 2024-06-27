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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Verificando se o campo de email não está vazio
    if (!empty($email)) {
        // Validando o email
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Dividindo o email para obter a parte antes do @
            $partes = explode('@', $email);
            $nome_usuario = $partes[0];
            echo "Nome de usuário: " . $nome_usuario;
        } else {
            echo "E-mail inválido.";
        }
    } else {
        echo "Por favor, insira um e-mail.";
    }
}
?>

<head>
    <title><?php echo $titulo ?> - Novo usuário</title>
    <link rel="stylesheet" href="../../../public/css/styles.css">
    <link rel="stylesheet" href="../../../public/css/novo_usuario.css">
</head>
<main class="pagina-novo-usuario">
    <div class="container-fluid text-center">
        <h3>Novo usuário</h3>
 
    <?php
    if (isset($_GET['inserir']) && isset($_GET['inserir']) == 1) { ?>
        <div class="ms-auto me-auto d-flex align-items-center justify-content-center alert alert-primary gap-2 w-25" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </svg>
            Novo usuário cadastrado!
        </div>
    <?php } ?>
    <div class="container mt-5">
        <form class="form-group" action="<?php echo $UserController . '?request=inserir'; ?>" method="post">
            <div class="d-flex justify-content-center p-2 gap-5">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="cliente[]" id="flexRadioDefault1" value="NDFANE001">
                    <label class="form-check-label" for="flexRadioDefault1">
                        ANEEL
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="cliente[]" id="flexRadioDefault2" value="NDFAGA001">
                    <label class="form-check-label" for="flexRadioDefault2">
                        ANATEL
                    </label>
                </div>
            </div>
            <div class="mb-3 row justify-content-end">
                <label for="inputNome" class="col-3 col-form-label text-end">Nome Completo:</label>
                <div class="col-9">
                    <input type="text" class="form-control" id="inputNome" name="nome" required>
                </div>
            </div>

            <div class="mb-3 row justify-content-end">
                <label for="inputEmail" class="col-3 col-form-label text-end">Email:</label>
                <div class="col-9">
                    <input type="email" class="form-control" id="inputEmail" name="email" required>
                </div>
            </div>

            <div class="mb-3 row justify-content-end align-items-center">
                <label for="inputPassword" class="col-3 col-form-label text-end">Senha Provisória:</label>
                <div class="col-9">
                    <input type="password" class="form-control" id="inputPassword" name="senha" required>
                </div>
            </div>

            <div class="mb-3 row justify-content-end">
                <label for="inputNome" class="col-3 col-form-label text-end">Ramal:</label>
                <div class="col-9">
                    <input type="text" class="form-control" id="inputNome" name="phone">
                </div>
            </div>

            <div class="mb-3 row justify-content-end">
                <label class="col-3 col-form-label text-end" for="autoSizingSelect">Grupo</label>
                <select class="col-9" name="grupo" id="autoSizingSelect">
                    <option value="ATENDENTE">ATENDENTE</option>
                    <option value="COORDENADOR">COORDENADOR</option>
                    <option value="PERFIL DE QUALIDADE">PERFIL DE QUALIDADE</option>
                </select>
            </div>

            <div class="d-flex justify-content-center">
                <button class="btn btn-primary w-25 justify-content-center m-3" type="submit">Salvar</button>
            </div>
        </form>

    </div>
</main>