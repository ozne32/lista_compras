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

    <title>Recupera senha</title>
</head>
<header class="container mb-5">
    <nav class="navbar bg-warning fixed-top">
        <div class="container">
            <h2 class="display-4 fw-normal text-center titulo">Compras</h2>
        </div>
    </nav>
</header>
<main class="container mt-5  d-flex justify-content-center">
    <?php if (!isset($_GET['email']) && !isset($_GET['token'])) { ?>
        <div style="margin-top:120px; width: 100%; max-width: 500px">
            <div class="card mx-auto"><!-- começo do card -->
                <div class="card-header">Recuperar senha:</div>
                <div class="card-body"> <!--começo do card-body-->
                    <form action="controller.php?acao=novaSenha" method="post">
                        <label for="email">Email:</label>
                        <input name='email' class="form-control" type="email" placeholder="exemplo:nome@gmail.com">
                        <div class="row">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success mt-3">Mandar email</button>
                            </div>
                        </div>
                </div>
                </form>
            </div><!--final do card-body-->
        </div><!--final do card-->
    <?php } ?>
    <?php if (isset($_GET['email']) && isset($_GET['token'])) { ?>
        <script>
            $.ajax({
                type: 'POST',
                url: 'controller.php?acao=verificaNovaSenha',
                data: { token: '<?php echo $_GET['token']?>',
                        email: '<?php echo $_GET['email']?>'
                 },
                success: function (response) {
                    if(response  ==1){
                        window.location.href='login.php?erro=solicitacaoInexistente';
                    }else if(response == 0){
                        console.log(response);
                    }
                },
                error: function (error) {
                    console.log('Erro:', error);
                }
            });
        </script>
        <div style="margin-top:120px; width: 100%; max-width: 500px">
            <div class="card mx-auto"><!-- começo do card -->
                <div class="card-header">Nova senha:</div>
                <div class="card-body"> <!--começo do card-body-->
                    <form action="controller.php?acao=trocarSenha&email=<?php echo $_GET['email']?>&token=<?php echo $_GET['token']?>" method="post">
                        <label for="senha">Nova senha:</label>
                        <input name='senha' class="form-control" type="password" placeholder="Coloque sua senha:">
                        <label for="nova_senha">Nova senha:</label>
                        <input name='nova_senha' class="form-control" type="password" placeholder="Coloque a nova senha:">
                        <div class="row">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success mt-3">Trocar a senha</button>
                            </div>
                        </div>
                </div>
                </form>
            </div><!--final do card-body-->
        </div><!--final do card-->
    <?php } ?>

   
</main>
<!-- importante tem que trocar isso aqui -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>
    

</html>