<?php
session_start();

// Arquivos necessários
require '../Models/Chamados.php';
require '../Models/User.php';
require "../../app/Services/ChamadoService.php";
require "../../app/Services/UserService.php";
require "../../app/Services/Conexao.php";
require '../../routes/views.php';
require '../../routes/controllers.php';
require '../../routes/models.php';


$request = isset($_GET["request"]) ? $_GET["request"] : null;

// Lógica para inserir usuário
if ($request === 'inserir') {
    if (isset($_POST['nome'], $_POST['email'], $_POST['cliente'], $_POST['senha'], $_POST['grupo'])) {
        $usuario = new User(); 

        // Atribuir valores ao objeto User ($usuario)
        $usuario->__set('nome', $_POST['nome']);
        $usuario->__set('email', $_POST['email']);
        $usuario->__set('cliente', $_POST['cliente']); 
        $usuario->__set('ramal', $_POST['phone']);
        $usuario->__set('password', $_POST['senha']);
        $usuario->__set('group', $_POST['grupo']);

        // Obter o nome de usuário a partir do email
        $email = $_POST['email'];
        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $partes = explode('@', $email);
            $nome_usuario = $partes[0];
            $usuario->__set('username', $nome_usuario);
        } else {
            header('Location: ' . $novo_usuario . '?inserir=erro_email');
            exit();
        }

        $conexao = new Conexao();
        $userservice = new UserService($conexao, $usuario);
        $userservice->inserir();

        // Redirecionar com mensagem de sucesso
        header('Location: ' . $novo_usuario . '?inserir=1');
        exit();
    } else {
        // Lidar com a falta de parâmetros necessários
        header('Location: ' . $novo_usuario . '?inserir=erro_parametros');
        exit();
    }
} elseif ($request === 'recuperar') {
    $chamado = new Chamado();
    $conexao = new Conexao();
    $chamadoservice = new ChamadoService($conexao, $chamado);
    $chamadoservice->recuperar();
    

} elseif ($request === 'atualizar()') {
    $chamado = new Chamado();
    $conexao = new Conexao();
    $chamadoservice = new ChamadoService($conexao, $chamado);
    $chamadoservice->atualizar();
    

} elseif ($request === 'remover' && isset($_GET['id'])) { // Exclusão de usuário
    try {
        $id_usuario = $_GET['id'];

        $usuario = new User();
        $usuario->__set('id_user', $id_usuario);

        
        $conexao = new Conexao();
        $userservice = new UserService($conexao, $usuario);
        $userservice->remover();

        
        header('Location: ' . $gestor . '?remover=1');
        exit();
    } catch (PDOException $e) {
        echo 'Erro ' . $e->getCode() . ' Mensagem: ' . $e->getMessage();
        exit();
    }
} elseif ($request === 'atualizarSenha') {
    if (isset($_SESSION['user_id'], $_POST['senha_atual'], $_POST['nova_senha'], $_POST['confirmar_nova_senha'])) {
        $idUsuario = $_SESSION['user_id'];
        $senhaAtual = $_POST['senha_atual'];
        $novaSenha = $_POST['nova_senha'];
        $confirmarNovaSenha = $_POST['confirmar_nova_senha'];

        // Validação de confirmação feita em JavaScript - função validarSenha()

        try {
            // Criar a conexão PDO se ainda não estiver criada
            if (!isset($conexao)) {
                $conexao = new Conexao;
            }

            // Inicializa o serviço e chama o método para atualizar a senha
            $usuario = new User();
            $userService = new UserService($conexao, $usuario);
            $userService->atualizarSenha($idUsuario, $senhaAtual, $novaSenha);

            // Redirecionar com mensagem de sucesso
            header('Location: ' . $config_usuario . '?senha_atualizada=1');
            exit();

        } catch (PDOException $e) {
            echo 'Erro de banco de dados: ' . $e->getMessage();
            exit();
        } catch (Exception $e) {
            echo 'Erro ao atualizar senha: ' . $e->getMessage();
            exit();
        }
    } else {
        echo "Dados incompletos para atualização de senha.";
        exit();
    }
}

