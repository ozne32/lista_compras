<?php 
class RedefiniSenhaService
{
    private $redefiniSenha;
    private $conn;
    public function __construct(RedefiniSenha $redefiniSenha, Conexao $conexao)
    {
        $this->redefiniSenha = $redefiniSenha;
        $this->conn = $conexao->conectar();
    }
    public function verificar(){
        $query = 'SELECT * from tb_redefini_senha where email = ?';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $this->redefiniSenha->email);
        $smtm->execute();
        return $smtm->fetch(PDO::FETCH_OBJ);
    }
    public function adicionar(){
        $query = 'INSERT INTO tb_redefini_senha(email, token) values (?,?)';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $this->redefiniSenha->email);
        $smtm->bindValue(2, $this->redefiniSenha->token);
        return $smtm->execute();
    }
    public function verificarExistencia(){
        $query = 'SELECT * from tb_redefini_senha where email = ? and token = ?';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $this->redefiniSenha->email);
        $smtm->bindValue(2, $this->redefiniSenha->token);
        $smtm->execute();
        return $smtm->fetch(PDO::FETCH_OBJ);
    }
    public function deletar(){
        $query = 'DELETE from tb_redefini_senha where email = ? and token = ?';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $this->redefiniSenha->email);
        $smtm->bindValue(2, $this->redefiniSenha->token);
        return $smtm->execute();
    }
}?>