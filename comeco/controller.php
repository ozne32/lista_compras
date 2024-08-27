<?php
require_once 'conexao.php';
require_once './models/produtos.php';
require_once './services/produto.service.php';
require_once './models/usuarios.php';
require_once './services/usuarios.service.php';
require_once './models/user_prod.php';
require_once './services/user_prods.service.php';
session_start();
$acao = $_GET['acao'];
$coisa;
if ($acao == 'adicionar') {
    $produto = new Produtos;
    $produto->__set('nome_produto', $_POST['nome_produto']);
    $conexao = new Conexao;
    $produtoService = new ProdutoService($produto, $conexao);
    $verificacao = $produtoService->verificar1();
    if ($verificacao) {
        header('location:add_rmv.php?erro=duplicada');
    } else {
        //não está vazio --> não coloque na lista
        if ($produtoService->inserir()) {
            $ids_produtos = $produtoService->verificar();
            $ids_produtos = $ids_produtos[0]['produto_id']; // aqui eu estou pegando o id do produto que eu acabei de fazer
            $userProd = new UserProd;
            $userProd->__set('id_prods', $ids_produtos);
            $userProd->__set('id_user', $_SESSION['id']);
            $userProdService = new UserProdService($userProd, $conexao);
            $userProdService->adicionar();
            header('location:add_rmv.php?status=sucesso');
        } else {
            header('location:add_rmv.php?status=falha');
        }
    }
}
if ($acao == 'deletar') {
    foreach ($_POST['lista'] as $nmr) {
        $ids_produtos .= $nmr . ',';
    }
    $ids_produtos = substr($ids_produtos, 0, -1);
    $produto = new Produtos;
    $produto->__set('produto_id', $ids_produtos);
    $conexao = new Conexao;
    $produtoService = new ProdutoService($produto, $conexao);
    print_r($produtoService);
    $produtoService->deletar();
}
if ($acao == 'atualizar') {
    $produto = new Produtos;
    $produto->__set('nome_produto', $_GET['valor']);
    $produto->__set('produto_id', $_GET['produto_id']);
    $conexao = new Conexao;
    $produtoService = new ProdutoService($produto, $conexao);
    if ($produtoService->verificar()) {
        header('location:index.php?erro=duplicada');
    } else {
        if ($produtoService->atualizar()) {
            header('location:index.php?status=sucesso_atualiza');
        } else {
            header('location:index.php?status=falha');
        }

    }
}
if ($acao == 'signup') {
    if ($_POST['senha-signin'] == $_POST['confirma-senha'] && $_POST['email'] != '' && $_POST['nome'] != '' && $_POST['senha'] != '') {
        // caso nada estiver vazio + a senha e confirmar senha estiver certo
        $usuario = new Usuarios;
        $usuario->__set('email', $_POST['email']);
        $usuario->__set('nome', $_POST['nome']);
        $usuario->__set('senha', $_POST['senha']);
        $conexao = new Conexao;
        $usuarioService = new UsuarioService($usuario, $conexao);
        $pessoa = $usuarioService->verificar();
        if ($usuarioService->verficarExistencia()) {
            header('location:sign-up.php?erro=cadastroExistente');
        } else {
            if ($usuarioService->cadastro()) {
                session_start();
                $_SESSION['verificar'] = 'verificado';
                $_SESSION['id'] = $pessoa->usuario_id;
                header('location:index.php');
            } else {
                echo 'deu erro';
            }
        }
    } else {
        header('location:sign-up.php?erro=campoVazio');
    }
    if ($_POST['senha-sigin'] != $_POST['confirma-senha']) {
        header('location:sign-up.php?erro=conf-senha');
    }
}

/*
SELECT * from tb_user_prods as tup 
inner join tb_produtos as tp
on tp.produto_id = tup.id_prods
where tup.id_user=?
 */
if (empty($coisa)) {
    $produto = new Produtos;
    $produto->__set('usuario_id', $_SESSION['id']);
    $conexao = new Conexao;
    $produtoService = new ProdutoService($produto, $conexao);
    $valores = $produtoService->todosVal();
    $_SESSION['valores'] = $valores;
}
if ($acao == 'login') {
    $usuario = new Usuarios;
    $conexao = new Conexao;
    $usuario->__set('email', $_POST['email']);
    $usuario->__set('senha', $_POST['senha']);
    $usuariosService = new UsuarioService($usuario, $conexao);
    $pessoa = $usuariosService->verificar();
    if (empty($pessoa)){
        header('location:login.php?erro=user-senhaErrada');
    } else{
        session_start();
        $_SESSION['verificar']='verificado';
        $_SESSION['id'] = $pessoa->usuario_id;
        header('location:index.php');
    }
}
if($acao =='logout'){
    session_start();
    session_destroy();
    header('location: login.php');
}
// echo '<pre>';
// print_r($_GET);
// echo '</pre>';