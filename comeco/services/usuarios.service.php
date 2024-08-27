<?php

class UsuarioService{
    private $usuario;
    private $conn;
    public function __construct(Usuarios $usuario, Conexao $conexao){
        $this->usuario=$usuario;
        $this->conn = $conexao->conectar();
    }
    public function verficarExistencia(){
        $query='SELECT * from tb_usuarios where email = ?';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1,$this->usuario->email);
        $smtm->execute();
        return $smtm->fetchAll(PDO::FETCH_OBJ);
    }
    public function verificar(){
        $query='SELECT * from tb_usuarios where email = ? and senha = ?';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1,$this->usuario->email);
        $smtm->bindValue(2,$this->usuario->senha);
        $smtm->execute();
        return $smtm->fetch(PDO::FETCH_OBJ);
    }
    public function cadastro(){
        $query = 'INSERT INTO tb_usuarios(email,nome,senha) values(?,?,?)';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1,$this->usuario->email);
        $smtm->bindValue(2,$this->usuario->nome);
        $smtm->bindValue(3,$this->usuario->senha);
        return $smtm->execute();
    }
}