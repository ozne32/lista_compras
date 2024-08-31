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
    public function adicionar(){
        $query = 'INSERT into tb_pedidos(id_user1, id_user2) values(?,?)';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $this->pedido->id_user1);
        $smtm->bindValue(2, $this->pedido->id_user2);
        return $smtm->execute();
    }
    public function deletar(){
        $query = 'DELETE from tb_pedidos where id_user1 = ? and id_user2 = ?';
        $smtm = $this->conn->prepare($query);
        $smtm->bindValue(1, $this->pedido->id_user1);
        $smtm->bindValue(2, $this->pedido->id_user2);
        return $smtm->execute();
    }
}

?>