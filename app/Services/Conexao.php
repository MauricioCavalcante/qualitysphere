<?php
class Conexao
{
    private $host = 'localhost';
    private $username = 'mauricio';
    private $password = 'Hitss@2024';
    private $dbname = 'db_servicedesk';

    public function conectar(){
        try {
            $conexao = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                "$this->username",
                "$this->password"
            );
            return $conexao;

        } catch (PDOException $e) {
            echo '<p>' . $e->getMessage(). '</p>';
        }
    }
}
?>