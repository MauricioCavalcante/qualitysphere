<?php 

class Chamado{
    private $id;
    private $atendente;
    private $cliente;
    private $num_chamado;
    private $titulo;
    private $audio;
    private $transcricao;
    private $avaliacao;
    private $feedback;
    private $data_rec;

    function __get($atributo){
        return $this->$atributo;
    }
    function __set($atributo, $value) {
        $this->$atributo = $value;
    }
};


?>