<?php
require_once 'conexao.php';
require_once './models/produtos.php';
require_once './services/produto.service.php';
require_once './models/usuarios.php';
require_once './services/usuarios.service.php';
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
if($acao=='signup'){
    if($_POST['senha-signin'] == $_POST['confirma-senha']){
        // caso dê tudo certo --> registrar
        $usuario = new Usuarios;
        $usuario->__set('email', $_POST['email']);
        $usuario->__set('nome', $_POST['nome']);
        $usuario->__set('senha', $_POST['senha']);
        $conexao = new Conexao;
        $usuarioService = new UsuarioService($usuario, $conexao);
        if($usuarioService->verficarExistencia()){
            header('location:sign-up.php?erro=cadastroExistente');
        }else{
            if($usuarioService->cadastro()){
                header('location:index.php');
            }else{
                echo 'deu erro';
            }
        }
    }else if($_POST['senha-signin'] != $_POST['confirma-senha']){
        //caso o confirma for diferente da senha --> volta com msg de erro
        header('location:sign-in.php?erro=conf-senha');
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