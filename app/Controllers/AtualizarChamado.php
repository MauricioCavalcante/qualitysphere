<?php
session_start();

// Arquivos necessários
require '../Models/Chamados.php';
require '../Models/User.php';
require "../../app/Services/ChamadoService.php";
require "../../app/Services/Conexao.php";
require '../../routes/views.php';
require '../../routes/controllers.php';
require '../../routes/models.php';

if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] != 'YES') {
    header('Location: ' . $login . '?login=erro2');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_chamado'])) {
    $id_chamado = $_POST['id_chamado'];
    $novo_cliente = $_POST['novo_cliente'];
    $novo_num_chamado = $_POST['novo_num_chamado'];
    $novo_titulo = $_POST['novo_titulo'];
    $novo_audio = $_POST['novo_audio'];
    $novo_feedback = $_POST['novo_feedback'];


    try {
        $conexao = new PDO($dbname, $db_username, $db_password);
        $query = "UPDATE tb_chamados SET titulo = :novo_titulo WHERE id_chamado = :id_chamado";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':novo_cliente', $novo_cliente, PDO::PARAM_STR);
        $stmt->bindParam(':novo_num_chamado', $novo_num_chamado, PDO::PARAM_STR);
        $stmt->bindParam(':novo_titulo', $novo_titulo, PDO::PARAM_STR);
        $stmt->bindParam(':novo_audio', $novo_audio, PDO::PARAM_STR);
        $stmt->bindParam(':novo_feedback', $novo_feedback, PDO::PARAM_STR);
        $stmt->bindParam(':id_chamado', $id_chamado, PDO::PARAM_INT);
        $stmt->execute();

        // Redirecionar de volta para a página de detalhes do chamado
        header('Location: ' . $details_chamado . '?id=' . $id_chamado);
        exit();
    } catch (PDOException $e) {
        echo 'Erro' . $e->getCode() . ' Mensagem:' . $e->getMessage();
        exit();
    }
} else {
    echo "Requisição inválida.";
    exit();
}
