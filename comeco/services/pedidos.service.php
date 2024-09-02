<?php
class PedidosService
{
    private $pedido;
    private $conn;
    public function __construct(Pedidos $pedido, Conexao $conexao)
    {
        $this->pedido = $pedido;
        $this->conn = $conexao->conectar();
    }
    public function adicionar()
    {
        $query = 'INSERT into tb_pedidos(id_user1, id_user2) values(?,?)';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $this->pedido->id_user1);
        $smtm->bindValue(2, $this->pedido->id_user2);
        return $smtm->execute();
    }
    public function deletar()
    {
        $query = 'DELETE from tb_pedidos where id_user1 = ? and id_user2 = ?';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $this->pedido->id_user1);
        $smtm->bindValue(2, $this->pedido->id_user2);
        return $smtm->execute();
    }
    public function verPedido()
    {
        $query = 'SELECT * from tb_pedidos where id_user1 = ? ';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $this->pedido->id_user1);
        $smtm->execute();
        return $smtm->fetchAll(PDO::FETCH_OBJ);
    }
    public function verSolicitacao()
    {
        $query = 'SELECT tp.id_user1, tu.nome from tb_pedidos as tp
        INNER JOIN tb_usuarios as tu on 
        tp.id_user1 = tu.usuario_id
        where id_user2= ? and visualizar = 0';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $this->pedido->id_user2);
        $smtm->execute();
        return $smtm->fetchAll(PDO::FETCH_OBJ);
    }
    public function aceitarSolicitacao(){
        $query = 'UPDATE tb_pedidos set visualizar = 1 where id_user1 = ? and id_user2 = ?';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $this->pedido->id_user1);
        $smtm->bindValue(2, $this->pedido->id_user2);
        return $smtm->execute();
    }
    public function recusarSolicitacao(){
        $query = 'DELETE FROM  tb_pedidos where id_user1 = ? and id_user2 = ?';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $this->pedido->id_user1);
        $smtm->bindValue(2, $this->pedido->id_user2);
        return $smtm->execute();
    }
}
?>