<?php
session_start();

$request = 'recuperar';

// // Caminho para os arquivos de views e controllers
require '../routes/views.php';
require '../routes/controllers.php';

// // Caminho para o arquivo Config.php
require '../app/Controllers/Config.php';

// // Validação de login de usuário
if (!isset($_SESSION['user'])) {
    header('Location:' . $login . '?login=erro2'); // ajuste o redirecionamento conforme necessário
}

// Incluir o cabeçalho da página
include("../resources/Views/layouts/header.php");

?>

<head>
<title>QualitySphere</title>
<link rel="stylesheet" href="../public/css/styles.css">
</head>

<main class="m-5">
    <h3>Bem vindo, <?php echo $_SESSION['user'] ?> !</h3>  
</main>


<script src="../../public/js/scripts.js"></script>