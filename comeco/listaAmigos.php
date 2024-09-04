<?php
session_start();
if (!isset($_SESSION['verificar']) || $_SESSION['verificar'] !== 'verificado') {
    header('Location: sign-up.php?erro=acessoRestrito');
    // exit();
}
$lista123 = 'pegarListasAmigos';
require_once 'controller.php';

?>
<!doctype html>
<html lang="pt-br">

<head>
    <title>adiciona e remove</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3a7cbcc65c.js" crossorigin="anonymous"></script>
</head>

<body>
    <header class="container mb-5">
        <nav class="navbar bg-warning fixed-top">
            <div class="container-fluid">
                <button class="navbar-toggler p-2" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars fa-lg p-2"></i>
                </button>
                <div class="container">
                    <h2 class="display-4 fw-normal text-center titulo">Compras</h2>
                </div>
                <!-- parte do canvas -->
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Loja de compras</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="index.php">Home(Conferir lista)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="add_rmv.php">Adicionar compras</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="lista.php">Ver listas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="listaAmigos.php">Lista dos amigos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="pedidos.php">fazer pedidos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="solicitacoes.php">pedidos pendentes</a>
                            </li>
                            <li class="nav-item">
                                <button class="btn btn-danger"
                                    onclick="window.location.href='controller.php?acao=logout'"><i
                                        class="fa-solid fa-power-off mr-1"></i> Logout</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="container pt-5">
        <h3 class="display-4 ">Ver lista dos amigos</h3>
        <?php if (!isset($_GET['lista_nome'])) { ?>
            <?php foreach($listaAmigos as $key=>$la){?>
                <?php if($key >0 && $la->nome_lista != $listaAmigos[$key-1]->nome_lista){?>
                    <button class="btn btn-success"> <?php echo $la->nome_lista?> <small><?php echo $la->nome?></small></button>
                <?php }if($key == 0){?>
                    <button class="btn btn-success"> <?php echo $la->nome_lista?> <br> <small style="font-size:70%"> De: <strong><?php echo ucfirst($la->nome)?> </strong></small></button>
                <?php }?>  
            <?php }?>
        <?php } ?>
        <?php if (isset($_GET['lista_nome'])) { ?>
        <?php } ?>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>