<?php

class ListaService{
    private $lista;
    private $conn;
    public function __construct(Lista $lista, Conexao $conexao){
        $this->lista = $lista;
        $this->conn = $conexao->conectar(); 
    }
    public function adicionar(){
        $query = 'INSERT INTO tb_listas(nome_lista, id_prods, id_user) values(?, ?, ?)';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $this->lista->nome);
        $smtm->bindValue(2, $this->lista->id_prods);
        $smtm->bindValue(3, $this->lista->id_user);
        return $smtm->execute();
    }
    public function verificar(){
        $query='SELECT * from tb_listas where nome_lista = ? and id_user = ? ';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $this->lista->nome);
        $smtm->bindValue(2, $_SESSION['id']);
        $smtm->execute();
        return $smtm->fetchAll(PDO::FETCH_OBJ);
    }
    public function verificarLista(){
        $query ='SELECT id_list  from tb_listas where nome_lista = ? and id_prods = ? and id_user = ?';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $this->lista->nome);
        $smtm->bindValue(2, $this->lista->id_prods);
        $smtm->bindValue(3, $_SESSION['id']);
        $smtm->execute();
        return $smtm->fetchAll(PDO::FETCH_OBJ);
    }
    public function pegarVals(){
        $query = 'SELECT * from tb_listas where id_user = ?';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $this->lista->id_user);
        $smtm->execute();
        return $smtm->fetchAll(PDO::FETCH_OBJ);
    }
    public function acharLista(){
        $query = ' SELECT tp.nome_produto, tp.produto_id
        FROM tb_listas AS tl
        INNER JOIN tb_produtos AS tp ON tl.id_prods = tp.produto_id
        WHERE tl.id_user = ? AND tl.nome_lista = ?;';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $_SESSION['id']);
        $smtm->bindValue(2, $this->lista->nome);
        $smtm->execute();
        return $smtm->fetchAll(PDO::FETCH_OBJ);
    }
    public function pegarId(){
        $query = 'SELECT id_lista from tb_listas where id_prods = ? and nome_lista = ? and id_user = ?';
        $smtm= $this->conn->prepare($query);
        $smtm->bindValue(1, $this->lista->id_prods);
        $smtm->bindValue(2, $this->lista->nome);
        $smtm->bindValue(3, $this->lista->id_user);
        $smtm->execute();
        return $smtm->fetch(PDO::FETCH_OBJ);
    }
    public function atualizar(){
        $query = 'UPDATE tb_listas set id_prods= ? where id_lista= ?';
        $smtm= $this->conn->prepare($query);
        $smtm->bindValue(1, $this->lista->id_prods);
        $smtm->bindValue(2, $this->lista->id_lista);
        return $smtm->execute();
    }
}