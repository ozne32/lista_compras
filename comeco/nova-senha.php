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

    <title>Login</title>
</head>
<header class="container mb-5">
    <nav class="navbar bg-warning fixed-top">
        <div class="container">
            <h2 class="display-4 fw-normal text-center titulo">Compras</h2>
        </div>
    </nav>
</header>
<main class="container mt-5  d-flex justify-content-center">
    <div style="margin-top:120px; width: 100%; max-width: 500px">
        <div class="card mx-auto"><!-- começo do card -->
            <div class="card-header">Recuperar senha:</div>
            <div class="card-body"> <!--começo do card-body-->
                <form action="controller.php?acao=login" method="post">
                    <label for="email">Email:</label>
                    <input name='email' class="form-control" type="email" placeholder="exemplo:nome@gmail.com">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-danger mt-3" onclick="window.location.href='login.php'">Voltar</button>
                                </div>
                                <div class="col-md-7">
                                    <button type="submit" class="btn btn-success mt-3">Mandar email</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-top:25px">
                        </div>
                    </div>
                </form>
            </div><!--final do card-body-->
        </div><!--final do card-->
    </div>
</main>
<?php require_once 'modal.php';?>
<?php if(isset($_GET['erro']) && $_GET['erro'] == 'user-senhaErrada'){?>
<script>
    $(document).ready(() => {
                $('#loginErrado').modal('show')
                $('#okButton3').on('click', ()=>{
                    $('#loginErrado').modal('hide')
                })
                $('#fecharId3').on('click', ()=>{
                    $('#loginErrado').modal('hide')
                })
            })
</script>
<?php }?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>

</html>