<?php 

class User{
    private $id;
    private $nome;
    private $username;
    private $senha;
    private $email;
    private $cliente;
    private $ramal;
    private $grupo;
    private $data_rec;

    function __get($atributo){
        return $this->$atributo;
    }
    function __set($atributo, $value) {
        $this->$atributo = $value;
    }
};


?>