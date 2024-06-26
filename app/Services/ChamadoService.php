<?php
//CRUD
class ChamadoService {

    private $conexao;
    private $chamado;

    public function __construct(Conexao $conexao, Chamado $chamado) {
        $this->conexao = $conexao->conectar();
        $this->chamado = $chamado;
    }

    public function inserir() {
        $query = 'INSERT INTO tb_chamados (id_user, id_cliente, num_chamado, titulo, audio)
                  VALUES (:atendente, :cliente, :num_chamado, :titulo, :audio)';
        $stmt = $this->conexao->prepare($query);

        
        $atendente = $this->chamado->__get('atendente');
        $cliente = $this->chamado->__get('cliente');
        $num_chamado = $this->chamado->__get('num_chamado');
        $titulo = $this->chamado->__get('titulo');
        $audio = $this->chamado->__get('audio');

        
        $stmt->bindParam(':atendente', $atendente);
        $stmt->bindParam(':cliente', $cliente);
        $stmt->bindParam(':num_chamado', $num_chamado);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':audio', $audio);
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
