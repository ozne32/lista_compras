<?php
session_start();
if (!isset($_SESSION['verificar']) || $_SESSION['verificar'] !== 'verificado') {
    header('Location: sign-up.php?erro=acessoRestrito');
    // exit();
}
require_once 'controller.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/3a7cbcc65c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <title>Inicio</title>
</head>

<body>
    <script>
        let lista_coisas = []
        let lista_inputs = []
        let lista_nomes = []
        function edita(id) {
            lista_inputs.push(id)
            let input = $(`#input${id}`)
            lista_nomes.push(input.prop('placeholder'))
            if (lista_inputs.length == 2) {
                let input1 = $(`#input${lista_inputs[0]}`)
                input1.prop('readonly', true)
                input1.attr('placeholder', lista_nomes[0])
                lista_inputs.splice(0, 1)
                lista_nomes.splice(0, 1)
            }
            input.trigger('focus')
            let novo_valor = '';
            input.prop('readonly', false)
            input.attr('placeholder', 'digite o novo valor')
            $(`#input${id}`).on('keypress', e => {
                if (e.keyCode == 13) {
                    window.location.href = `controller.php?acao=atualizar&valor=${$(e.target).val()}&produto_id=${id}`
                } else {
                    novo_valor = $(e.target).val()
                    console.log(novo_valor)
                }
            })
        }
    </script>
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
                        <h5>Olá, <?php echo ucfirst($_SESSION['nome_usuario']) ?> </h5>
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="lista.php">Ver listas</a>
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
                                <a class="nav-link" href="amigos.php">amigos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="seguidores.php">seguidores</a>
                            </li>
                            <li class="nav-item">
                                <button class="btn btn-danger"
                                    onclick="window.location.href='controller.php?acao=logout'"><i
                                        class="fa-solid fa-power-off mr-1"></i> Logout</button>
                            </li>
                            <?php if ($_SESSION['id'] == 1) { ?>
                                <li class="nav-item">
                                    <button class="btn btn-danger mt-2"
                                        onclick="window.location.href='controller.php?acao=removerDuplicadas'"><i
                                            class="fa-solid fa-trash mr-1 mt-2"></i> Remover itens inúteis</button>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="container pt-5">
        <div class="container">
            <h3 class="display-4 mb-2"> Lista de produtos </h3>
            <div class="container">
                <form action="controller.php?acao=adicionar" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Digite o nome do produto"
                            aria-label="Digite o nome do produto:" aria-describedby="button-addon" name="nome_produto"
                            id="inputColoca">
                        <button class="btn btn-success" type="submit" id="button-addon">Adicionar</button>
                    </div>
                </form>
            </div>
            <script>
                $(document).ready(function () {
                    $('#inputColoca').focus();
                });
            </script>
            <div class=" mt-3">
                <?php foreach ($_SESSION['valores'] as $val) { ?>
                    <div class="input-group mb-3">
                        <div class="input-group-text">
                            <input class="form-check-input mt-0" type="checkbox" value="<?php echo $val->produto_id ?>"
                                onclick="adiciona(<?php echo $val->produto_id ?>)">
                            <script>
                                function adiciona(valor) {
                                    let indexValor = lista_coisas.indexOf(valor)
                                    if (indexValor == -1) {
                                        lista_coisas.push(valor)
                                    } else {
                                        lista_coisas.splice(indexValor, 1)
                                    }
                                } 
                            </script>
                        </div>
                        <input type="text" class="form-control" id="input<?php echo $val->produto_id ?>"
                            placeholder="<?php echo $val->nome_produto ?>" readonly="true">
                        <button class="btn" onclick="edita(<?php echo $val->produto_id ?>)"
                            style="border: 0.1px solid black; border-radius: 0px 10px 10px 0px ;">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </div>
                <?php } ?>
                <!-- <div class='inputs-group mb-3'>
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" type="checkbox">
                    </div>
                </div> -->
            </div>
            <div class="row mt-2">
                <!-- colocar um active para cada um desses botões -->
                <?php if (!empty($_SESSION['valores'])) { ?>
                    <div class="col-md-1">
                        <script>
                            <?php $_SESSION['remover'] ?> = lista_coisas
                        </script>
                        <button class="btn  btn-danger" id="click-delete">
                            Deletar </button>
                        <?php require_once 'modal.php' ?>
                        <script>
                            $('#click-delete').on("click", function () {
                                $('#delModal').modal('show')
                                $('#btnYes').on('click', () => {
                                    $.ajax({
                                        type: 'POST',
                                        url: 'controller.php?acao=deletar',
                                        data: { lista: lista_coisas },
                                        success: function (response) {
                                            window.location.href = 'index.php?status=sucesso-rmv'
                                        },
                                        error: function (error) {
                                            console.log('Erro:', error);
                                        }
                                    });
                                })
                                $('#btnNo').on('click', () => {
                                    $('#delModal').modal('hide')
                                })
                                $('#fecharId4').on('click', () => {
                                    $('#delModal').modal('hide')
                                })
                            })
                        </script>
                    </div>
                    <div class="col-md-3">
                        <button class="btn  btn-primary" id='cria_lista'> Criar lista</button>
                        <script>
                            $('#cria_lista').on('click', () => {
                                $('#criarModel').modal('show')
                                $('#fecharId5').on('click', () => {
                                    $('#criarModel').modal('hide')
                                })
                                $('#btnCancela').on('click', () => {
                                    $('#criarModel').modal('hide')
                                })
                            })
                        </script>
                    </div>
                <?php } ?>
            </div>

        </div>
    </main>
    <?php require_once 'modal.php' ?>
    <?php if (isset($_GET['status']) && $_GET['status'] == 'vazio') { ?>
        <script>
            $(document).ready(() => {
                $('#campoVazio').modal('show')
                $('#okButton2').on('click', () => {
                    $('#campoVazio').modal('hide')
                })
                $('#fecharId2').on('click', () => {
                    $('#campoVazio').modal('hide')
                })
            })
        </script>
    <?php } ?>
    <?php if (isset($_GET['erro']) && $_GET['erro'] == 'duplicada') { ?>
        <script>
            $(document).ready(() => {
                $('#duplicada').modal('show')
                $('#fecharDuplicada').on('click', () => {
                    $('#duplicada').modal('hide')
                })
                $('#btnSair').on('click', () => {
                    $('#duplicada').modal('hide')
                })
            })
        </script>
    <?php } ?>
    <?php if (isset($_GET['erro']) && $_GET['erro'] == 'duplicadaItem') { ?>
        <script>
            $(document).ready(() => {
                $('#duplicadaItem').modal('show')
                $('#fecharDuplicadaItem').on('click', () => {
                    $('#duplicadaItem').modal('hide')
                })
                $('#btnSairItem').on('click', () => {
                    $('#duplicadaItem').modal('hide')
                })
            })
        </script>
    <?php } ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>