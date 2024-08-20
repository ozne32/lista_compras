<?php
class Conexao{
    private $user='root';
    private $host='db';
    private $dbname='compras';
    private $senha='root';

    public function conectar(){
        try{
            $conexao = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                "$this->user",
                "$this->senha"
            );
            return $conexao;
        }catch(PDOException $e){
            echo 'Erro' . $e->getCode(). '<br>Mensagem:' . $e->getMessage();
        }
    }
}