<?php 
class UserProd{
    private $id_prods;
    private $id_user;
    public function __get($attr){
        return $this->$attr;
    }
    public function __set($attr, $val){
        $this->$attr = $val;
        return $this;
    }
}
?>