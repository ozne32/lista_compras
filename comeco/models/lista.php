<?php
class Lista{
    private $nome;
    private  $id_prods;
    private $id_user;
    private $id_lista;
    public function __get($attr){
        return $this->$attr;
    }
    public function __set($attr, $value){
        $this->$attr = $value;
        return $this;
    }
};
