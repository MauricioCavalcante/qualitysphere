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
    <title>QualitySphere - Novo usuário</title>
    <link rel="stylesheet" href="../../../public/css/styles.css">
</head>
<main>
    <div class="container-fluid text-center">
        <h3>Novo usuário</h3>
    </div>
    <div class="container w-50 mt-5">
        <form class="form-group" action="<?php echo $UserController . '?request=inserir'; ?>" method="post">

            <div class="mb-3 row justify-content-end">
                <label for="inputNome" class="col-3 col-form-label text-end">Nome Completo:</label>
                <div class="col-9">
                    <input type="text" class="form-control" id="inputNome" name="nome">
                </div>
            </div>

            <div class="mb-3 row justify-content-end">
                <label for="inputEmail" class="col-3 col-form-label text-end">Email:</label>
                <div class="col-9">
                    <input type="email" class="form-control" id="inputEmail" name="email">
                </div>
            </div>

            <div class="mb-3 row justify-content-end align-items-center">
                <label for="inputPassword" class="col-3 col-form-label text-end">Senha Provisória:</label>
                <div class="col-9">
                    <input type="password" class="form-control" id="inputPassword" name="senha">
                </div>
            </div>

            <div class="d-flex p-2 gap-5">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="cliente[]" id="flexRadioDefault1" value="ANEEL" onchange="mostrarCliente()">
                    <label class="form-check-label" for="flexRadioDefault1">
                        ANEEL - NDFANE001
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="cliente[]" id="flexRadioDefault2" value="ANATEL" onchange="mostrarCliente()">
                    <label class="form-check-label" for="flexRadioDefault2">
                        ANATEL - NDFAGA001
                    </label>
                </div>
            </div>

            <div class="mb-3 row justify-content-end">
                <label for="inputNome" class="col-3 col-form-label text-end">Ramal:</label>
                <div class="col-9">
                    <input type="text" class="form-control" id="inputNome" name="phone">
                </div>
            </div>

            <div class="mb-3 row justify-content-end ">
                <label class="col-3 col-form-label text-end" >Grupo</label>
                <select class="col-9" name="grupo">
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