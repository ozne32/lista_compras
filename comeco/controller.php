<?php
require_once 'conexao.php';
require_once './models/produtos.php';
require_once './services/produto.service.php';
session_start();
$acao = $_GET['acao'];
if($acao == 'adicionar'){
    $produto = new Produtos;
    $produto->__set('nome_produto', $_POST['nome_produto']);
    $conexao = new Conexao;
    $produtoService=new ProdutoService($produto, $conexao);
    if($produtoService->verificar()){
        //está vazio --> coloque na lista
        header('location:add_rmv.php?erro=duplicada');
    }else{
        //não está vazio --> não coloque na lista
        if($produtoService->inserir()){
            header('location:add_rmv.php?sucesso=inserida');
        }else{
            echo 'agr fudeu';
        }
    }
}
if(empty($acao)){
    $produto = new Produtos;
    $conexao = new Conexao;
    $produtoService = new ProdutoService($produto, $conexao);
    $valores = $produtoService->todosVal();
    $_SESSION['valores']=$valores;
}
// echo '<pre>';
// print_r($_GET);
// echo '</pre>';