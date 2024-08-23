<?php
require_once 'conexao.php';
require_once './models/produtos.php';
require_once './services/produto.service.php';
session_start();
$acao = $_GET['acao'];
$coisa;
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
            header('location:add_rmv.php?status=sucesso');
        }else{
            header('location:add_rmv.php?status=falha');
        }
    }
}
if($acao == 'deletar'){
    foreach($_POST['lista'] as $nmr){
        $ids_produtos .=$nmr .',';
    }
    $ids_produtos = substr($ids_produtos, 0, -1);
    $produto = new Produtos;
    $produto->__set('produto_id', $ids_produtos);
    $conexao = new Conexao;
    $produtoService = new ProdutoService($produto, $conexao);
    print_r($produtoService);
    $produtoService->deletar();
}
if($acao =='atualizar'){
    $produto = new Produtos;
    $produto->__set('nome_produto', $_GET['valor']);
    $produto->__set('produto_id', $_GET['produto_id']);
    $conexao = new Conexao;
    $produtoService=new ProdutoService($produto, $conexao);
    if($produtoService->verificar()){
        header('location:index.php?erro=duplicada');
    }else{
        if($produtoService->atualizar()){
            header('location:index.php?status=sucesso_atualiza');
        }else{
            header('location:index.php?status=falha');
        }

    }
}
if(empty($coisa)){
    $produto = new Produtos;
    $conexao = new Conexao;
    $produtoService = new ProdutoService($produto, $conexao);
    $valores = $produtoService->todosVal();
    $_SESSION['valores']=$valores;
}
// echo '<pre>';
// print_r($_GET);
// echo '</pre>';