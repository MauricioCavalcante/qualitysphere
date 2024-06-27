<?php
session_start();

// Limpeza das variáveis de sessão
$_SESSION['user'] = '';
$_SESSION['cliente'] = '';
$_SESSION['user_name'] = '';
$_SESSION['group'] = '';

// Inclusão dos arquivos de configuração e rotas
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

        // Consulta SQL com placeholders para prevenir SQL injection
        $query = 'SELECT * FROM tb_user WHERE (email = :username OR username = :username)';
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['password'])) {
            // Senha verificada com sucesso
            $_SESSION['user_id'] = $usuario['id_user'];
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
