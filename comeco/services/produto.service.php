<?php
class ProdutoService{
    private $produto;
    private $conn;
    public function __construct(Produtos $produto, Conexao $conexao){
        $this->produto=$produto;
        $this->conn = $conexao->conectar();
    }
    public function inserir(){
        $query='insert into tb_produtos(nome_produto)';
        $query .='values(?)';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1,$this->produto->__get('nome_produto'));
        return $smtm->execute();
    }
    public function verificar(){
        $query='select * from tb_produtos where nome_produto=?';
        $smtm=$this->conn->prepare($query);
        $smtm->bindValue(1, $this->produto->__get('nome_produto'));
        $smtm->execute();
        return $smtm->fetchAll();
    }
    public function todosVal(){
        $query='SELECT * from tb_produtos order by nome_produto asc';
        $smtm=$this->conn->prepare($query);
        $smtm->execute();
        return $smtm->fetchAll(PDO::FETCH_OBJ);
    }
    public function deletar(){
        $query='delete from tb_produtos where id_produto in ('. $this->produto->produto_id .');';
        $smtm = $this->conn->prepare($query);
        // $smtm->bindValue(1, $this->produto->produto_id);
        // echo $this->produto->produto_id;
        return $smtm->execute();
    }
}