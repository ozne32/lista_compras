<?php 
class UserProdService{  
    private $userProd;
    private $conn;
    public function __construct(UserProd $userProd, Conexao $conexao){
        $this->userProd=$userProd;
        $this->conn = $conexao->conectar();
    }
    public function adicionar(){
        $query = 'INSERT INTO tb_user_prods(id_prods,id_user) values(?,?)';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $this->userProd->id_prods);
        $smtm->bindValue(2, $this->userProd->id_user);
        return $smtm->execute();
    }
}
?>