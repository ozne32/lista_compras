<?php 

class RedefiniSenha{
    private $email;
    private $token;
    public function __get($attr){
        return $this->$attr;
    }
    public function __set($attr, $value){
        $this->$attr = $value;
        return $this;
    }
}
?>