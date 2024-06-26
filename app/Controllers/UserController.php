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

// Verifique se o parâmetro 'request' está definido na URL
$request = isset($_GET["request"]) ? $_GET["request"] : null;

// Lógica para inserir usuário
if ($request === 'inserir') {
    if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['cliente']) && isset($_POST['ramal']) && isset($_POST['senha'])) {
        $user = new Chamado();

        $user->__set('nome', $_POST['nome']);
        $user->__set('email', $_POST['email']);
        $user->__set('cliente', $_POST['cliente']);
        $user->__set('ramal', $_POST['phone']);
        $user->__set('password', $_POST['senha']);
        $user->__set('email', $_POST['email']);
        
        

        $conexao = new Conexao();
        $userservice = new UserService ($conexao, $user);
        $userservice->inserir();

        // Redirecione para a página de novo chamado com mensagem de sucesso
        header('Location: ' . $novo_chamado . '?inserir=1');
        exit();
    } else {
        // Lidar com a falta de parâmetros necessários
        header('Location: ' . $novo_chamado . '?inserir=erro');
        exit();
    }
} elseif ($request === 'recuperar') {
    $chamado = new Chamado();
    $conexao = new Conexao();
    $chamadoservice = new ChamadoService($conexao, $chamado);
    $chamadoservice->recuperar();
    

} elseif ($request === 'remover' && isset($_GET['id'])) {
    try {
        $id_chamado = $_GET['id'];
        
        $conexao = new Conexao();

        $user->__set('id_chamado', $id_chamado);

        $conexao = new Conexao();
        $userservice = new UserService ($conexao, $user);
        $userservice->inserir();

        // Redireciona para a página de chamados com uma mensagem de sucesso
        header('Location: ' . $chamados . '?remover=1');
        exit();
    } catch (PDOException $e) {
        echo 'Erro ' . $e->getCode() . ' Mensagem: ' . $e->getMessage();
        exit();
    }
} ;
