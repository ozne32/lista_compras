<html>
<!-- vai ficar um pouco de standby, eu já arrumo isso # -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/3a7cbcc65c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>Inicio</title>
</head>
<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Ajuda Notas</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="#" class="nav-link active">Sign-in</a></li>
            <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
        </ul>
    </nav>
</header>
<main class="container">
    <div class="corpo-registro">
        <div class="card"><!-- começo do card -->
            <div class="card-header">Sign-in:</div>
            <div class="card-body"> <!--começo do card-body-->
                <form action="tarefa_controller.php?acao=inserir" method="post">
                    <label for="email">Email:</label>
                    <input name='email-signin' class="form-control" type="email" placeholder="exemplo:nome@gmail.com">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" plaholder="usuario:" name='nome'>
                    <label for="senha">Senha:</label>
                    <input type="password" name='senha-signin' class="form-control">
                    <label for="senha">Confirmar senha:</label>
                    <input type="password" name='confirma-senha' class="form-control">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-dark mt-3">Criar conta</button>
                        </div>
                        <? if (isset($_GET['erro']) && $_GET['erro'] == 'incompleto') { ?>
                            <p class="text-danger ml-3">Por favor preencher todos os campos</p>
                        <? } ?>
                        <? if (isset($_GET['erro']) && $_GET['erro'] == 'acesso') { ?>
                            <p class="text-danger">Faça a sua conta primeiro</p>
                        <? } ?>
                        <div class="col-md-6" style="margin-top:25px">
                            <p><a href="login.php" style="text-decoration: none;">Já tem conta? Clique aqui</a></p>
                        </div>
                    </div>
                </form>
            </div><!--final do card-body-->
        </div><!--final do card-->
    </div>
</main>

</html>