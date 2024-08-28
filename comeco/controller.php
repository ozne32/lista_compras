<?php
require_once 'conexao.php';
require_once './models/produtos.php';
require_once './services/produto.service.php';
require_once './models/usuarios.php';
require_once './services/usuarios.service.php';
require_once './models/user_prod.php';
require_once './services/user_prods.service.php';
require_once './models/lista.php';
require_once './services/lista.service.php';
session_start();
$acao = $_GET['acao'];
$coisa;
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
    if (empty($pessoa)) {
        header('location:login.php?erro=user-senhaErrada');
    } else {
        session_start();
        $_SESSION['verificar'] = 'verificado';
        $_SESSION['id'] = $pessoa->usuario_id;
        header('location:index.php');
    }
}

if ($acao == 'logout') {
    session_start();
    session_destroy();
    header('location: login.php');
}

if ($acao == 'adicionar') {
    $produto = new Produtos;
    $produto->__set('nome_produto', $_POST['nome_produto']);
    $conexao = new Conexao;
    $produtoService = new ProdutoService($produto, $conexao);
    $verificacao = $produtoService->verificar();
    if (!empty($verificacao)) {
        header('location:add_rmv.php?erro=duplicada');
    } else if (empty($verificacao)) {
        $idProduto = $produtoService->verificarExistencia()->produto_id;
        if (!empty($idProduto)) { //produto já existe, então eu vou pegar e só atribuir ele na tabela user_prods
            $userProd = new UserProd;
            $userProd->__set('id_prods', $idProduto);
            $userProd->__set('id_user', $_SESSION['id']);
            $userProdService = new UserProdService($userProd, $conexao);
            if ($userProdService->adicionar()) {
                header('location:add_rmv.php?status=sucesso');
            } else {
                header('location:add_rmv.php?status=erro');
            }
        } else if (empty($idProduto)) {
            if ($produtoService->inserir()) {
                $ids_produtos = $produtoService->verId(); //pegando o id
                $userProd = new UserProd;
                $userProd->__set('id_prods', $ids_produtos[0]['produto_id']);
                $userProd->__set('id_user', $_SESSION['id']);
                $userProdService = new UserProdService($userProd, $conexao);
                $userProdService->adicionar();
                header('location:add_rmv.php?status=sucesso');
            } else {
                header('location:add_rmv.php?status=falha');
            }
        }
    }
}
if ($acao == 'deletar') {
    foreach ($_POST['lista'] as $nmr) {
        $ids_produtos .= $nmr . ',';
    }
    $ids_produtos = substr($ids_produtos, 0, -1);
    $userProd = new UserProd;
    $userProd->__set('id_prods', $ids_produtos);
    $userProd->__set('id_user', $_SESSION['id']);
    $conexao = new Conexao;
    $produtoService = new UserProdService($userProd, $conexao);
    $produtoService->deletar();
}
if ($acao == 'atualizar') {
    $produto = new Produtos;
    $produto->__set('nome_produto', $_GET['valor']);
    $produto->__set('produto_id', $_GET['produto_id']);
    $conexao = new Conexao;
    $produtoService = new ProdutoService($produto, $conexao);
    if ($produtoService->verificar()) { // aqui vê se vai ter duplicada, dentro do perfil
        header('location:index.php?erro=duplicada');
    } else {
        // meu objetivo agr é pegar esse valor novo, ver se está na lista de produtos, se estiver eu vou trocar ele 
        // no tb_user_prod, se não tiver eu vou só criar um novo, sem dar update, pois, pode ser um produto interessante para 
        // o futuro
        $existencia = $produtoService->verificarExistencia()->produto_id;
        if (!empty($existencia)) {
            $userProd = new UserProd;
            $userProd->__set('id_prods', $existencia);
            $userProd->__set('id_user', $_GET['produto_id']);
            $userProdService = new UserProdService($userProd, $conexao);
            if ($userProdService->atualizar()) {
                header('location:index.php?status=sucesso');
            } else {
                header('location:index.php?status=erro');
            }
        } else {
            $produto = new Produtos;
            $produto->__set('nome_produto', $_GET['valor']);
            $produtoService = new ProdutoService($produto, $conexao);
            $produtoService->inserir();
            $userProd = new UserProd;
            $userProd->__set('id_prods', $produtoService->verificarExistencia()->produto_id);
            $userProd->__set('id_user', $_GET['produto_id']);
            $userProdService = new UserProdService($userProd, $conexao);
            if ($userProdService->atualizar()) {
                header('location:index.php?status=sucesso');
            } else {
                header('location:index.php?status=erro');
            }
        }
        print_r($existencia->produto_id);
        // if ($produtoService->atualizar()) {
        //     header('location:index.php?status=sucesso_atualiza');
        // } else {
        //     header('location:index.php?status=falha');
        // }

    }
}
if ($acao == 'signup') {
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    if ($_POST['senha'] == $_POST['conf-senha'] && $_POST['email'] != '' && $_POST['nome'] != '' && $_POST['senha'] != '' && $_POST['conf-senha'] != '') {
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
                $pessoa = $usuarioService->verificar();
                session_start();
                $_SESSION['verificar'] = 'verificado';
                $_SESSION['id'] = $pessoa->usuario_id;
                header('location:index.php');
            } else {
                echo 'deu erro';
            }
        }
    } else if ($_POST['senha'] != $_POST['conf-senha']) {
        header('location:sign-up.php?erro=conf-senha');
    } else {
        header('location:sign-up.php?erro=campoVazio');
    }
}
if ($acao == 'cria_lista') {
    $nome = $_POST['nome'];
    foreach ($_SESSION['valores'] as $val) {
        $id_prods = $val->id_prods;
        $id_user = $val->id_user;
        $conexao = new Conexao;
        $lista = new Lista;
        $lista->__set('nome', $nome);
        $lista->__set('id_prods', $id_prods);
        $lista->__set('id_user', $id_user);
        $listaService = new ListaService($lista, $conexao);
        if(empty($listaService->verificar())){
            $listaService->adicionar();
            $userProd = new UserProd;
            $userProd->__set('id_prods', $id_prods);
            $userProd->__set('id_user', $id_user);
            $userProdService = new UserProdService($userProd, $conexao);
            $userProdService->deletar();
        }else{
            header('location:index.php?erro=duplicada');
            die();
        }
    }
    header('location:index.php');
}
if($lista =='pegarItem'){
    $lista = new Lista;
    $conexao = new Conexao;
    $lista->__set('id_user', $_SESSION['id']);
    $listaService = new ListaService($lista, $conexao);
    $_SESSION['vals_lista']=$listaService->pegarVals();
}