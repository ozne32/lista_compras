<?php

class ListaService{
    private $lista;
    private $conn;
    public function __construct(Lista $lista, Conexao $conexao){
        $this->lista = $lista;
        $this->conn = $conexao->conectar(); 
    }
    public function adicionar(){
        $query = 'INSERT INTO tb_listas(nome, id_prods, id_user) values(?, ?, ?)';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $this->lista->nome);
        $smtm->bindValue(2, $this->lista->id_prods);
        $smtm->bindValue(3, $this->lista->id_user);
        return $smtm->execute();
    }
    public function verificar(){
        $query='SELECT * from tb_listas where nome = ?';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $this->lista->nome);
        $smtm->execute();
        return $smtm->fetchAll(PDO::FETCH_OBJ);
    }
}