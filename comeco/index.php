<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/3a7cbcc65c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Inicio</title>
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
                                <a class="nav-link active" aria-current="page" href="index.php">Home(Conferir lista)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="add_rmv.php">Adicionar/remover compras</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Compras
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Compra 1</a></li>
                                    <li><a class="dropdown-item" href="#">Compra 2</a></li>
                                    <!-- <li>
                                        <hr class="dropdown-divider">
                                    </li> -->
                                    <li><a class="dropdown-item" href="#">Compra 3</a></li>
                                </ul>
                            </li>
                        </ul>
                        <!-- form de pesquisa que pode ser incrementado dps -->
                        <!-- <form class="d-flex mt-3" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form> -->
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="container pt-5">
        <div class="container">
            <h3 class="display-4 mb-2"> Lista de produtos </h3>
            <div class="row justify-content-around mt-2">
                <!-- colocar um active para cada um desses botões -->
                <div class="col-md-3">
                    <button class="btn btn-lg btn-success">Adicionar</button>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-lg btn-warning"> Alterar </button>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-lg btn-danger"> Deletar </button>
                </div>
            </div>
            <table class="table table-striped mt-5">
                <tbody>
                    <tr>
                        <td class="lead fw-normal">Compra 1</td>
                    </tr>
                    <tr>
                        <td class="lead fw-normal">Compra 2</td>
                    </tr>
                    <tr>
                        <td class="lead fw-normal">Compra 3</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    <footer></footer>







    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>