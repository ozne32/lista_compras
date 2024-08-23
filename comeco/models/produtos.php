<?php
class Produtos{
    private $produto_id;
    private  $nome_produto;
    private $id_pessoa;
    private $comprado;
    public function __get($attr){
        return $this->$attr;
    }
    public function __set($attr, $value){
        $this->$attr = $value;
        return $this;
    }
};
