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
require_once './models/pedidos.php';
require_once './services/pedidos.service.php';
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
        $_SESSION['nome_usuario'] = $pessoa->nome;
        header('location:index.php');
    }
}

if ($acao == 'logout') {
    session_start();
    session_destroy();
    header('location: login.php');
}

if ($acao == 'adicionar') {
    if ($_POST['nome_produto'] != '') {
        $produto = new Produtos;
        $produto->__set('nome_produto', $_POST['nome_produto']);
        $conexao = new Conexao;
        $produtoService = new ProdutoService($produto, $conexao);
        $verificacao = $produtoService->verificar();
        if (!empty($verificacao)) {
            header('location:index.php?erro=duplicadaItem');
        } else if (empty($verificacao)) {
            $idProduto = $produtoService->verificarExistencia()->produto_id;
            if (!empty($idProduto)) { //produto já existe, então eu vou pegar e só atribuir ele na tabela user_prods
                $userProd = new UserProd;
                $userProd->__set('id_prods', $idProduto);
                $userProd->__set('id_user', $_SESSION['id']);
                $userProdService = new UserProdService($userProd, $conexao);
                if ($userProdService->adicionar()) {
                    header('location:index.php?status=sucesso');
                } else {
                    header('location:index.php?status=erro');
                }
            } else if (empty($idProduto)) {
                if ($produtoService->inserir()) {
                    $ids_produtos = $produtoService->verId(); //pegando o id
                    $userProd = new UserProd;
                    $userProd->__set('id_prods', $ids_produtos[0]['produto_id']);
                    $userProd->__set('id_user', $_SESSION['id']);
                    $userProdService = new UserProdService($userProd, $conexao);
                    $userProdService->adicionar();
                    header('location:index.php?status=sucesso');
                } else {
                    header('location:index.php?status=falha');
                }
            }
        }
    } else {
        header('location:index.php?status=vazio');
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
        header('location:index.php?erro=duplicadaItem');
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
                $_SESSION['nome_usuario'] = $pessoa->nome;
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
    if($nome == ''){
        header('location:index.php?status=vazio');
        exit();
    }else{
        $conexao = new Conexao;
        $lista = new Lista;
        $lista->__set('nome', $nome);
        $listaService = new ListaService($lista, $conexao);
        print_r($listaService->verificar());
        if (empty($listaService->verificar())) {
                echo 'chegou aqui';
            // echo 'chegou';
            foreach ($_SESSION['valores'] as $val) {
                $id_prods = $val->id_prods;
                $id_user = $val->id_user;
                $lista = new Lista;
                $lista->__set('nome', $nome);
                $lista->__set('id_prods', $id_prods);
                $lista->__set('id_user', $_SESSION['id']);
                $listaService = new ListaService($lista, $conexao);
                $listaService->adicionar();
                $userProd = new UserProd;
                $userProd->__set('id_prods', $id_prods);
                $userProd->__set('id_user', $id_user);
                $userProdService = new UserProdService($userProd, $conexao);
                $userProdService->deletar();
            }
            echo "<script>window.location.href='index.php'</script>";
            exit();
        }
        if (!empty($listaService->verificar())) {
            echo "<script>window.location.href='index.php?erro=duplicada'</script>";
            exit();
            }
    }
}
if ($lista == 'pegarItem') {
    $lista = new Lista;
    $conexao = new Conexao;
    $lista->__set('id_user', $_SESSION['id']);
    $listaService = new ListaService($lista, $conexao);
    $lista = [];
    // print_r($listaService->pegarVals());
    foreach($listaService->pegarVals() as $vals){
        array_push($lista, $vals->nome_lista);
    };
    // print_r(array_unique($lista));
    $_SESSION['vals_lista'] = array_unique($lista);
}
if ($acao == 'pegarValores') {
    $nome_lista = $_POST['nome_lista'];
    $lista = new Lista;
    $conexao = new Conexao;
    // echo $nome_lista;
    $lista->__set('nome', $nome_lista);
    $lista->__set('id_user', $_SESSION['id']);
    $listaService = new ListaService($lista, $conexao);
    $resultado = $listaService->acharLista();
    header('Content-Type: application/json');
    echo json_encode(['resultado' => $resultado]);
}
if ($acao == 'atualizarLista') {
    /*
        passos:
            1-verificar se o nome colocado existe na tabela de produtos e pegar o id
            2-se sim eu só atualizo a lista listaService    
            3-se não eu faço um novo produto e passo ele direto para lista pego o id
            4-coloco na Lista
    */
    // passo 1 vendo se o nome colocado existe na tabela de produtos 
    $produto = new Produtos;
    $produto->__set('nome_produto', $_GET['valor']);
    $conexao = new Conexao;
    // pegar o id da lista
    $lista = new Lista;
    $lista->__set('nome', $_GET['nome_lista']);
    $lista->__set('id_prods', $_GET['id_prod']);
    $lista->__set('id_user', $_SESSION['id']);
    $listaService = new ListaService($lista, $conexao);
    $id_lista = $listaService->pegarId()->id_lista;
    // verificar se está na lista tb_produtos existe e se tiver é para pegar o id
    $produtoService = new ProdutoService($produto, $conexao);
    $pegarId = $produtoService->verificarLista();
    if (empty($pegarId)) {
        // caso objeto não exista ainda  
        // adicionar na lista
        $produtoService->inserir();
        $pegarId = $produtoService->verificarLista()->produto_id;
        // fazer a lista e fazer o update dela
        $lista->__set('id_prods', $pegarId);
        $lista->__set('id_lista', $id_lista);
        $listaService = new ListaService($lista, $conexao);
        if ($listaService->atualizar()) {
            header('location:lista.php?lista_nome=' . $_GET['nome_lista']);
            exit();
        }
    } else {
        // aqui é muito mais fácil, já tenho o id da lista e do produto, só fazer o update
        $lista->__set('id_lista', $id_lista);
        $lista->__set('id_prods', $pegarId->produto_id);
        $listaService = new ListaService($lista, $conexao);
        $listaService->atualizar();
        if ($listaService->atualizar()) {
            header('location:lista.php?lista_nome=' . $_GET['nome_lista']);
            exit();
        }
    }
}
if ($listaUser == 'verdadeiro') {
    $user = new Usuarios;
    $user->__set('usuario_id', $_SESSION['id']);
    $conexao = new Conexao;
    $userService = new UsuarioService($user, $conexao);
    $usuarios = $userService->pegarUsuarios();
    $pedido = new Pedidos;
    $pedido->__set('id_user1', $_SESSION['id']); //usuário que eu estou
    $pedidoService = new PedidosService($pedido, $conexao);
    $pedidos = json_encode($pedidoService->verPedido());
}
if ($acao == 'fazerPedido') {
    $pedido = new Pedidos;
    $pedido->__set('id_user1', $_SESSION['id']); // usuário logado
    $pedido->__set('id_user2', $_GET['user_id']); // usuário que vai receber o pedido
    $conexao = new Conexao;
    $pedidoService = new PedidosService($pedido, $conexao);
    if ($pedidoService->adicionar()) {
        header('location:pedidos.php');
    }
    ;
}
if ($acao == 'desFazerPedido') {
    $pedido = new Pedidos;
    $pedido->__set('id_user1', $_SESSION['id']); // usuário logado
    $pedido->__set('id_user2', $_GET['user_id']); // usuário que vai receber o pedido
    $conexao = new Conexao;
    $pedidoService = new PedidosService($pedido, $conexao);
    if ($pedidoService->deletar()) {
        header('location:pedidos.php');
        exit();
    }
    ;
}
if ($pegarSolicitacao == 'verdadeiro') {
    $pedido = new Pedidos;
    $pedido->__set('id_user2', $_SESSION['id']);
    $conexao = new Conexao;
    $pedidoService = new PedidosService($pedido, $conexao);
    $solicitacao = $pedidoService->verSolicitacao();
}
if ($acao == 'aceitarSolicitacao') {
    $pedido = new Pedidos;
    $pedido->__set('id_user1', $_GET['id_user1'])->
        __set('id_user2', $_SESSION['id']);
    $conexao = new Conexao;
    $pedidoService = new PedidosService($pedido, $conexao);
    if ($pedidoService->aceitarSolicitacao()) {
        header('location:solicitacoes.php');
        exit();
    }
    ;
}
if ($acao == 'recusarSolicitacao') {
    $pedido = new Pedidos;
    $pedido->__set('id_user1', $_GET['id_user1'])->
        __set('id_user2', $_SESSION['id']);
    $conexao = new Conexao;
    $pedidoService = new PedidosService($pedido, $conexao);
    if ($pedidoService->recusarSolicitacao()) {
        header('location:solicitacoes.php');
        exit();
    }
    ;
}
if ($lista123 == 'pegarListasAmigos') {
    // pegar o id dos usuários que eu posso ver
    $pedidos = new Pedidos;
    $pedidos->__set('id_user1', $_SESSION['id']);
    $conexao = new Conexao;
    $pedidoService = new PedidosService($pedidos, $conexao);
    $listaAmigos = $pedidoService->verUsuarios();
    $lista = [];
    foreach($listaAmigos as $val){
        $pedidos->__set('id_user2', $val->id_user2);
        array_push($lista, $pedidoService->verListas());
    }
    $listaNome = [];
    $userNome = [];
    $userId = [];
    foreach($lista as $val){
        foreach($val as $valor){
            if(!in_array($valor->nome_lista, $listaNome)){
                $listaNome[] = $valor->nome_lista;
                $userNome[] = $valor->nome;
                $userId[] = $valor->usuario_id;
            }
        }
    }
}
if ($acao == 'pegarListaAmigo') {
    $lista = new Lista;
    $lista->__set('nome', $_GET['nome_lista'])->
        __set('id_user', $_GET['usuario_id']);
    $conexao = new Conexao;
    $listaService = new ListaService($lista, $conexao);
    $valores = $listaService->acharLista();
    $_SESSION['valores_lista'] = $valores;
    header('location:listaAmigos.php?lista_nome=' . $_GET['nome_lista'] . '&id_amigo=' . $_GET['usuario_id']);
}
if($acao =='removerDuplicadas'){
    $lista = new Lista;
    $conexao = new Conexao;
    $listaService = new ListaService($lista, $conexao);
    $valExcluidos = $listaService->pegarDuplicadas();
    echo '<pre>';
    print_r($valExcluidos);
    echo '</pre>';
    if(!empty($valExcluidos)){
        $valores = '';
        foreach($valExcluidos as $val){
            $valores .= $val->produto_id .',';
        }
        $valores = substr($valores, 0, -1);
        echo $valores;
        $produtos = new Produtos;
        $produtos->__set('produto_id', $valores);
        print_r($produtos);
        $produtoService = new ProdutoService($produtos, $conexao);
        if($produtoService->deletar()){
            echo "<script>window.location.href='index.php'</script>";
            exit();
        };
    }else{
        echo "<script>window.location.href='index.php'</script>";
        exit();
    }
}


if ($acao == 'agruparLista') {

    $listaUsuario = $_POST['produto_id'];// aqui vai ter o nome da lista do usuário que está logado
    $listaSerAgrupadaNome = $_GET['lista_nome']; // lista do usuário que não é oq está logado
    $listaSerAgrupadaId = $_GET['idUsuario']; //id do usuário que não é oq está logado
    if($listaUsuario == 'Clique aqui para selecionar a lista'){
        header('location:listaAmigos.php');
        exit();
    }
    /*primeiro eu vou pegar todos os elementos que estão na listaSerAgrupado, fazer um array com isso, após isso eu vou adicionar na Lista 1 a 1 com o insert só que eu preciso
    ver se tem elementos repetidos, eu pensei em pegar os ids e dar um for para cada produto que aparecer, ou eu posso dar um inner para ver os elementos que tem 
    aí eu posso ir removendo os itens com um loop for msm utilizando o array_search($value, $array) e dps o unset($array[$index])*/
    $listaSerAgrupada = new Lista;
    $listaSerAgrupada->__set('nome', $listaSerAgrupadaNome);
    $listaSerAgrupada->__set('id_user', $listaSerAgrupadaId);
    // print_r($listaSerAgrupada);

    $conexao = new Conexao;
    $listaService = new ListaService($listaSerAgrupada, $conexao);
    $listaId = [];
    $listaUser = [];
    foreach ($listaService->acharLista() as $val) {
        array_push($listaId, $val->produto_id);
    }
    ;
    $listaUserLogado = new Lista;
    $listaUserLogado->__set('nome', $listaUsuario);
    $listaUserLogado->__set('id_user', $_SESSION['id']);
    $listaService = new ListaService($listaUserLogado, $conexao);
    foreach ($listaService->acharLista() as $val) {
        array_push($listaUser, $val->produto_id);
    };
    foreach ($listaUser as $idU) {
        $index = array_search($idU, $listaId);
        unset($listaId[$index]);
    }
    $tamanhoLista = count($listaId);
    if (empty($listaId)) { 
        header('location: listaAmigos.php');
        exit();
    }else{
        foreach ($listaId as $key => $ids) {
            if ($key == $tamanhoLista - 1) {
                $listaUserLogado->__set('id_prods', $ids);
                $listaService = new ListaService($listaUserLogado, $conexao);
                if($listaService->adicionar()){
                    header('location: listaAmigos.php');
                    exit();
                }
            } 
             if ($key != $tamanhoLista - 1) {
                $listaUserLogado->__set('id_prods', $ids);
                $listaService = new ListaService($listaUserLogado, $conexao);
                $listaService->adicionar();
            }
        }
    } 
}
if($acao=='removerLista'){
    $lista = new Lista;
    $lista->__set('nome', $_GET['lista_nome']);
    $lista->__set('id_user', $_SESSION['id']);
    $conexao = new Conexao;
    $listaService = new ListaService($lista, $conexao);
    if($listaService->deletarLista()){
        header('location: lista.php');
        exit();
    }
}
if($pegarAmigosLindos=='pegarAmigos'){
    $pedido=new Pedidos;
    $pedido->__set('id_user1', $_SESSION['id']);
    $conexao = new Conexao;
    $pedidoService = new PedidosService($pedido, $conexao);
    $usuariosAmigos = $pedidoService->verUsuarios();
    $usersAmigos = [];
    foreach($usuariosAmigos as $val){
        $usuario = new Usuarios;
        $usuario->__set('usuario_id', $val->id_user2);
        $usuarioService = new UsuarioService($usuario, $conexao);
        $usersAmigos[] = $usuarioService->pegarNome();
    }
}
if($acao =='pararSeguir'){
    $pedido = new Pedidos;
    $pedido->__set('id_user1', $_SESSION['id']);
    $pedido->__set('id_user2', $_GET['id_user']);
    $conexao = new Conexao;
    $pedidoService = new PedidosService($pedido, $conexao);
    if($pedidoService->pararSeguir()){
        header('location: amigos.php');
        exit();
    };
}
if($acao =='pararSeguir'){
    $pedido = new Pedidos;
    $pedido->__set('id_user1', $_SESSION['id']);
    $pedido->__set('id_user2', $_GET['id_user']);
    $conexao = new Conexao;
    $pedidoService = new PedidosService($pedido, $conexao);
    if($pedidoService->pararSeguir()){
        header('location: amigos.php');
        exit();
    };
}
if($pegarSeguidores =='pegarSeguidores'){
    $pedido = new Pedidos;
    $pedido->__set('id_user2', $_SESSION['id']);
    $conexao = new Conexao;
    $pedidoService = new PedidosService($pedido, $conexao);
    $seguidores = $pedidoService->pegarSeguidores();
    $seguidoresNomes = [];
    foreach($seguidores as $val){
        $usuario = new Usuarios;
        $usuario->__set('usuario_id', $val->id_user1);
        $usuarioService = new UsuarioService($usuario, $conexao);
        $seguidoresNomes[] = $usuarioService->pegarNome();
    }
}
if($acao == 'tirarSeguidor'){
    $pedido = new Pedidos;
    $pedido->__set('id_user2', $_SESSION['id']);
    $pedido->__set('id_user1', $_GET['id_user']);
    $conexao = new Conexao;
    $pedidoService = new PedidosService($pedido, $conexao);
    if($pedidoService->pararSeguir()){
        header('location: seguidores.php');
        exit();
    };
}
if($acao =='editaLista'){
    $lista = new Lista;
    $lista->__set('nome', $_POST['valor']);
    $lista->__set('novo_nome', $_POST['valor_novo']);
    $lista->__set('id_user', $_SESSION['id']);
    $conexao = new Conexao;
    $listaService = new ListaService($lista, $conexao);
    // $listaService->editarNomeLista();
    if($listaService->editarNomeLista()){
        echo true;
    };
}
?>