<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/3a7cbcc65c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>Sign-up</title>
</head>
<header class="container mb-5">
        <nav class="navbar bg-warning fixed-top">
            <div class="container">
                <div class="container">
                    <h2 class="display-4 fw-normal text-center titulo">Compras</h2>
                </div>
                <!-- parte do canvas -->
            </div>
        </nav>
    </header>
<main class="container mt-5  d-flex justify-content-center">
    <div style="margin-top:120px; width: 100%; max-width: 500px">
        <div class="card mx-auto" ><!-- começo do card -->
            <div class="card-header">Sign-in:</div>
            <div class="card-body"> <!--começo do card-body-->
                <form action="controller.php?acao=signup" method="post">
                    <label for="email">Email:</label>
                    <input name='email' class="form-control" type="email" placeholder="exemplo:nome@gmail.com">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" plaholder="usuario:" name='nome'>
                    <label for="senha">Senha:</label>
                    <input type="password" name='senha' class="form-control">
                    <label for="senha">Confirmar senha:</label>
                    <input type="password" name='conf-senha' class="form-control">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-warning mt-3">Criar conta</button>
                        </div>
                        <div class="col-md-6" style="margin-top:25px">
                            <p><a href="login.php" style="text-decoration: none;">Já tem conta? Clique aqui</a></p>
                        </div>
                    </div>
                </form>
            </div><!--final do card-body-->
        </div><!--final do card-->
    </div>
</main>  
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</html>