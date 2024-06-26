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

// Lógica para inserir chamado
if ($request === 'inserir') {
    if (isset($_SESSION['user']) && isset($_POST['cliente']) && isset($_POST['num_chamado']) && isset($_POST['titulo']) && isset($_FILES['audio'])) {
        $chamado = new Chamado();

        $chamado->__set('atendente', $_SESSION['user']);
        $chamado->__set('cliente', $_POST['cliente']);
        $chamado->__set('num_chamado', $_POST['num_chamado']);
        $chamado->__set('titulo', $_POST['titulo']);

        // Processando o upload do arquivo de áudio
        $targetDir = "../../public/upload/"; 
        $targetFile = $targetDir . basename($_FILES["audio"]["name"]);
        $audioFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Verifica se o arquivo é realmente um áudio
        $allowedTypes = ['mp3', 'wav', 'ogg'];
        if (in_array($audioFileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["audio"]["tmp_name"], $targetFile)) {
                // Sucesso no upload, definindo o caminho do arquivo no objeto Chamado
                $chamado->__set('audio', $targetFile);

                $conexao = new Conexao();
                $chamadoservice = new ChamadoService($conexao, $chamado);
                $chamadoservice->inserir();

                
                header('Location: ' . $novo_chamado . '?inserir=1');
                exit();
            } 
        } else {
            // Tipo de arquivo não permitido
            header('Location: ' . $novo_chamado . '?inserir=tipo_nao_permitido');
            exit();
        }
    } else {
        
        header('Location: ' . $novo_chamado . '?inserir=erro');
        exit();
    }
} elseif ($request === 'recuperar') {
    // TODO: script de recuperar/atualizar e editar chamado

} elseif ($request === 'remover' && isset($_GET['id'])) {
    try {
        $id_chamado = $_GET['id'];
        
        $conexao = new Conexao();
        $chamado = new Chamado();
        $chamado->__set('id_chamado', $id_chamado);

        $chamadoservice = new ChamadoService($conexao, $chamado);
        $chamadoservice->remover();

        // Redireciona para a página de chamados com uma mensagem de sucesso
        header('Location: ' . $chamados . '?remover=1');
        exit();
    } catch (PDOException $e) {
        echo 'Erro ' . $e->getCode() . ' Mensagem: ' . $e->getMessage();
        exit();
    }
} ;
