<?php
session_start();
if (!isset($_SESSION['verificar']) || $_SESSION['verificar'] !== 'verificado') {
    header('Location: sign-up.php?erro=acessoRestrito');
    // exit();
}
$lista = 'pegarItem';
require_once 'controller.php';
require_once 'modal.php';

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
                    <h5>Olá, <?php echo ucfirst($_SESSION['nome_usuario']) ?> </h5>
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="index.php">Home</a>
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
        <?php if (!isset($_GET['lista_nome'])) { ?>
            <div class="row">
                <!-- esse aqui que vai ficar com repeat -->
                <?php foreach ($_SESSION['vals_lista'] as $valor) { ?>
                    <div class="col-md-4 mt-2">
                        <button class="btn btn-primary btn-lg"
                            onclick="window.location.href = 'lista.php?lista_nome=<?php echo $valor ?>'"><?php echo $valor ?></button>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <?php if (isset($_GET['lista_nome'])) { ?>
            <h3 class="display-4 mb-2"><?php echo ucfirst($_GET['lista_nome']) ?></h3>
            <script>
                $.ajax({
                    type: 'POST',
                    url: 'controller.php?acao=pegarValores',
                    data: { nome_lista: '<?php echo $_GET['lista_nome'] ?>' },
                    success: function (response) {
                        console.log(response)
                        let resposta = response.resultado
                        resposta.forEach((element) => {
                            // jogar mais um produto para dentro da tabela
                            // criar o tr 
                            lista_ids = []
                            lista_nomes = []
                            let tr = document.createElement('tr')
                            let td = document.createElement('td')
                            td.id = 'td' + element.produto_id
                            td.innerHTML = element.nome_produto
                            td.className = 'lead fw-normal'
                            let button = document.createElement('button')
                            button.className = 'btn btn-lg'
                            button.innerHTML = '<i class="fa-solid fa-pen-to-square"></i>'
                            button.style = 'border: 0.1px solid black; border-radius: 0px 10px 10px 0px;'
                            button.onclick = () => {
                                lista_nomes.push(element.nome_produto);
                                td.innerHTML = `<input type='text' class='form-control' id='input${element.produto_id}'
                                            placeholder='Digite o novo valor:'>`
                                $(`#input${element.produto_id}`).focus()
                                lista_ids.push(element.produto_id)
                                $(`#input${element.produto_id}`).on('keypress', e => {
                                    if (e.keyCode == 13) {
                                        window.location.href = `controller.php?acao=atualizarLista&valor=${$(e.target).val()}&nome_lista=<?php echo $_GET['lista_nome'] ?>&id_prod=${element.produto_id}`
                                    } else {
                                        novo_valor = $(e.target).val()
                                    }
                                })
                                if (lista_ids.length == 2) {
                                    let td1 = document.getElementById(`td${lista_ids[0]}`)
                                    td1.innerHTML = lista_nomes[0]
                                    lista_ids.splice(0, 1)
                                    lista_nomes.splice(0, 1)
                                }
                            };
                            tr.appendChild(td)
                            tr.appendChild(button)
                            document.getElementById('corpo-tabela').appendChild(tr)
                        });
                    },
                    error: function (error) {
                        console.log('Erro:', error);
                    }
                });
            </script>
            <table class="table table-striped">
                <tbody id="corpo-tabela">
                    <tr>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-danger" onclick="window.location.href = 'lista.php'"><i
                    class="fa-solid fa-angle-left"></i> Voltar</button>
            <button class="btn btn-danger"  id="removBtn">Remover</button>
            <script>
                    $('#removBtn').on('click', ()=>{
                        $('#delLista').modal('show')
                    })
                    $('#fecharId10').on('click', ()=>{
                        $('#delLista').modal('hide')
                    })
                    $('#btnNo1').on('click', ()=>{
                        $('#delLista').modal('hide')
                    })
            </script>
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