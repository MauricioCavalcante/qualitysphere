<?php
//CRUD
class UserService {
    private $conexao;
    private $user;

    public function __construct(Conexao $conexao, User $user) {
        $this->conexao = $conexao->conectar();
        $this->user = $user;
    }

    public function inserir() {
        
        // Opções de clientes vinculado ao usuário
        $clientes = implode(' / ', $this->user->__get('cliente'));
        
        $hashed_password = password_hash($this->user->__get('password'), PASSWORD_DEFAULT);
    

        $query = 'INSERT INTO tb_user (nome, username, email, cliente, phone, `group`, password)
                  VALUES (:nome, :username, :email, :cliente, :phone, :group, :password)';
        
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':nome', $this->user->__get('nome'));
        $stmt->bindValue(':username', $this->user->__get('username'));
        $stmt->bindValue(':email', $this->user->__get('email'));
        $stmt->bindValue(':cliente', $clientes); // Use a string convertida aqui
        $stmt->bindValue(':phone', $this->user->__get('ramal'));
        $stmt->bindValue(':group', $this->user->__get('group'));
        $stmt->bindValue(':password', $hashed_password); // Use a senha hashada
        $stmt->execute();
    }    

    public function recuperar() {
        $query = 'SELECT * FROM tb_user';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

    public function atualizar() {
        // TODO: Script para editar usuario
    }

    public function remover() {
        $query = 'DELETE FROM tb_user WHERE id_user = :id_user';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id_user', $this->user->__get('id_user'));
        $stmt->execute();
    }
    public function atualizarSenha($idUsuario, $senhaAtual, $novaSenha) {
        try {
            // Buscar senha atual do banco de dados para comparação
            $querySelect = 'SELECT password FROM tb_user WHERE id_user = :id';
            $stmtSelect = $this->conexao->prepare($querySelect);
            $stmtSelect->bindValue(':id', $idUsuario, PDO::PARAM_INT);
            $stmtSelect->execute();
            $usuario = $stmtSelect->fetch(PDO::FETCH_ASSOC);
    
            if (!$usuario) {
                throw new Exception('Usuário não encontrado.');
            }
    
            // Verificar se a senha atual digitada corresponde à senha armazenada no banco de dados
            if (!password_verify($senhaAtual, $usuario['password'])) {
                throw new Exception('Senha atual incorreta.');
            }
    
            // Hash da nova senha
            $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
    
            // Query para atualizar a senha
            $queryUpdate = 'UPDATE tb_user SET password = :senha WHERE id_user = :id';
            $stmtUpdate = $this->conexao->prepare($queryUpdate);
            $stmtUpdate->bindValue(':senha', $senhaHash);
            $stmtUpdate->bindValue(':id', $idUsuario, PDO::PARAM_INT);
            $stmtUpdate->execute();
    
        } catch (PDOException $e) {
            throw new Exception('Erro de banco de dados: ' . $e->getMessage());
        }
    }
    
    
}
?>
