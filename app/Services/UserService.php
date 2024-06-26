<?php
//CRUD
class UserService {

    private $conexao;
    private $chamado;

    public function __construct(Conexao $conexao, Chamado $chamado) {
        $this->conexao = $conexao->conectar();
        $this->chamado = $chamado;
    }

    public function inserir() {
        $query = 'INSERT INTO tb_chamados (nome, username, email, cliente, phone)
                  VALUES (:nome, :username, :email, :cliente, :phone)';
        $stmt = $this->conexao->prepare($query);

        
        $nome = $this->chamado->__get('nome');
        $username = $this->chamado->__get('username');
        $email = $this->chamado->__get('email');
        $cliente = $this->chamado->__get('cliente');
        $phone = $this->chamado->__get('phone');

        
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':cliente', $cliente);
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
    }

    public function recuperar() {
        $query = 'SELECT * FROM tb_chamados';
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

    public function atualizar() {
        // TODO: Script para editar chamado
    }

    public function remover() {
        $query = 'DELETE FROM tb_chamados WHERE id_chamado = :id_chamado';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':id_chamado', $this->chamado->__get('id_chamado'));
        $stmt->execute();
    }
}
?>
