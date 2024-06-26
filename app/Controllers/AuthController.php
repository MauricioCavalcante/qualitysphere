<?php

session_start();


$_SESSION['user'] = '';
$_SESSION['cliente'] = '';
$_SESSION['user_name'] = '';
$_SESSION['group'] = '';

require 'Config.php';
require '../../routes/views.php';
require '../../routes/controllers.php';

try {
    // Criando a conexão PDO
    $conexao = new PDO($dbname, $db_username, $db_password);

    // Verificando se os dados foram enviados via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['senha'])) {
        $username = $_POST['username'];
        $senha = $_POST['senha'];

        // Requisição separada para evitar injeção de SQL
        $query = 'SELECT * FROM tb_user WHERE (email = :username OR username = :username) AND password = :senha';
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            $_SESSION["user"] = $usuario['nome'];
            $_SESSION['user_name'] = $usuario['username'];
            $_SESSION['cliente'] = $usuario['cliente'];
            $_SESSION['group'] = $usuario['group'];
            header('Location: ' . $index); // Usuário logado, redirecionado para homepage
            exit;
        } else {
            header('Location: ' . $login . '?login=erro'); // Erro ao realizar login, redirecionado novamente para a página de login
            exit;
        }
    } else {
        header('Location: ' . $login . '?login=erro'); // Erro ao realizar login, redirecionado novamente para a página de login
        exit;
    }
} catch (PDOException $e) {
    echo 'Erro ' . $e->getCode() . ' Mensagem: ' . $e->getMessage();
    exit;
}
?>
