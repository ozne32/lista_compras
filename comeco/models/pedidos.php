<?php
class Pedidos{
    private $id_pedido;
    private $id_user1; // id do usuário que está logado
    private $id_user2; // id do usuário para qual o usuário quer fazer o pedido
    private $visualizar;
    public function __get($attr){
        return $this->$attr;
    }
    public function __set($attr, $val){
        $this->$attr = $val;
        return $this;
    }
}
?>