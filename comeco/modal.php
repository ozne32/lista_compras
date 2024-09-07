<!-- modal Senha Confirma-->
<div class="modal" tabindex="-1" role="dialog" id="modalSenhaConfirma" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Senha repetida</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close" id="fecharId">
                    <span aria-hidden="true"><i class="fa-solid fa-x fa-sm"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Os inputs de senha e confirmar senha precisam ser iguais
                </p>
            </div>
            <div class="modal-footer">
                <a href="#" type="button" class="btn btn-danger" id="okButton">Ok!</a>
            </div>
        </div>
    </div>
</div>
<!-- caso o  usuário já exista -->
<div class="modal" tabindex="-1" role="dialog" id="modalCadastroExistente" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Usuário já registrado</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close" id="fecharId1">
                    <span aria-hidden="true"><i class="fa-solid fa-x fa-sm"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Este email já está registrado
                </p>
            </div>
            <div class="modal-footer">
                <a href="#" type="button" class="btn btn-danger" id="okButton1">Ok!</a>
            </div>
        </div>
    </div>
</div>
<!-- preencha todos os campos -->
<div class="modal" tabindex="-1" role="dialog" id="campoVazio" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Campos</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close" id="fecharId2">
                    <span aria-hidden="true"><i class="fa-solid fa-x fa-sm"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Preencha todos os campos para continuar
                </p>
            </div>
            <div class="modal-footer">
                <a href="#" type="button" class="btn btn-danger" id="okButton2">Ok!</a>
            </div>
        </div>
    </div>
</div>
<!-- senha errada -->
<div class="modal" tabindex="-1" role="dialog" id="loginErrado" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Verificação</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close" id="fecharId3">
                    <span aria-hidden="true"><i class="fa-solid fa-x fa-sm"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Usuário ou senha estão errados
                </p>
            </div>
            <div class="modal-footer">
                <a href="#" type="button" class="btn btn-danger" id="okButton3">Ok!</a>
            </div>
        </div>
    </div>
</div>
<!-- Deletar -->
<div class="modal" tabindex="-1" role="dialog" id="delModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Deletar</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close" id="fecharId4">
                    <span aria-hidden="true"><i class="fa-solid fa-x fa-sm"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Tem certeza que quer deletar esses elementos ?
                </p>
            </div>
            <div class="modal-footer">
                <a href="#" type="button" class="btn btn-danger" id="btnYes">Sim!</a>
                <a href="#" type="button" class="btn btn-danger" id="btnNo">Não!</a>
            </div>
        </div>
    </div>
</div>
<!-- criar lista -->
<div class="modal" tabindex="-1" role="dialog" id="criarModel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success">Criar lista</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close" id="fecharId5">
                    <span aria-hidden="true"><i class="fa-solid fa-x fa-sm"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="controller.php?acao=cria_lista" method="post">
                    <label for="lista_nome">Digite o nome da sua lista:</label>
                    <input type="text" id="lista_nome" placeholder="Nome da Lista:" class="form-control" name="nome">
                    <button class='btn btn-success btn-sm mt-2' type="submit">Criar</button>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" type="button" class="btn btn-danger" id="btnCancela">Cancelar</a>
            </div>
        </div>
    </div>
</div>
<!-- Agrupar listas -->
<div class="modal" tabindex="-1" role="dialog" id="agrupaLista" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success">Criar lista</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close" id="fecharId6">
                    <span aria-hidden="true"><i class="fa-solid fa-x fa-sm"></i></span>
                </button>
            </div>
            <form action="controller.php?acao=agruparLista&lista_nome=<?php echo $_GET['lista_nome']?>&idUsuario=<?php echo $_GET['id_amigo']?>" method="post">
                <div class="modal-body">
                    <div class="form-floating">
                        <select class="form-select" id="listaSeleciona" name="produto_id" aria-label="Selecione a lista">
                            <option  selected>Clique aqui para selecionar a lista</option>
                            <?php foreach ($_SESSION['vals_lista'] as $val) { ?>
                                    <option value="<?php echo $val?>"><?php echo $val ?></option>
                            <?php } ?>
                        </select>
                        <label for="listaSeleciona">Listas</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Agrupar</button>
                    <a href="#" type="button" class="btn btn-danger" id="btnCancela1">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
