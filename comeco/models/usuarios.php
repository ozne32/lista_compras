<?php
class Usuarios{
    private $usuario_id;
    private  $email;
    private $nome;
    private $senha;
    public function __get($attr){
        return $this->$attr;
    }
    public function __set($attr, $value){
        $this->$attr = $value;
        return $this;
    }
};
