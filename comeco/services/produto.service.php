<?php
class ProdutoService{
    private $produto;
    private $conn;
    public function __construct(Produtos $produto, Conexao $conexao){
        $this->produto=$produto;
        $this->conn = $conexao->conectar();
    }
    public function inserir(){
        $query='INSERT into tb_produtos(nome_produto)';
        $query .='values(?)';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1,$this->produto->__get('nome_produto'));
        return $smtm->execute();
    }
    public function verId(){
        $query = 'SELECT produto_id from tb_produtos where nome_produto = ?';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $this->produto->__get('nome_produto'));
        $smtm->execute();
        return $smtm->fetchAll();
    }
    public function verificar(){
        $query = '
        SELECT * from tb_user_prods as tup
            inner join tb_produtos as tp
            on tp.produto_id = tup.id_prods
            where tup.id_user=? and
            tp.nome_produto = ?
            order by nome_produto asc';
        $smtm=$this->conn->prepare($query);
        $smtm->bindValue(1, $_SESSION['id']);
        $smtm->bindValue(2, $this->produto->__get('nome_produto'));
        $smtm->execute();
        return $smtm->fetchAll(PDO::FETCH_OBJ);
    }
    public function todosVal(){
        $query='
         SELECT * from tb_user_prods as tup 
            inner join tb_produtos as tp
            on tp.produto_id = tup.id_prods
            where tup.id_user=?
            order by nome_produto asc
        ';
        $smtm=$this->conn->prepare($query);
        $smtm->bindValue(1, $this->produto->usuario_id);
        $smtm->execute();
        return $smtm->fetchAll(PDO::FETCH_OBJ);
    }
    public function deletar(){
        $query='delete from tb_produtos where produto_id in ('. $this->produto->produto_id .');';
        $smtm = $this->conn->prepare($query);
        return $smtm->execute();
    }
    public function atualizar(){
        $query='UPDATE tb_produtos set nome_produto = ? where produto_id = ?';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $this->produto->nome_produto);
        $smtm->bindValue(2, $this->produto->produto_id);
        return $smtm->execute();
    }
}