<div class="modal" tabindex="-1" role="dialog" id="modalCadExistente" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Email já utilizado</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close" id="fecharId">
                    <span aria-hidden="true"><i class="fa-solid fa-x fa-sm"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    esse email já está sendo utilizado
                </p>
            </div>
            <div class="modal-footer">
                <a href="#" type="button" class="btn btn-danger" id="okButton">Ok!</a>
            </div>
        </div>
    </div>
</div>
<script>
     $(document).ready(() => {
                $('#modalCadExistente').modal('show')
                $('#okButton').on('click', ()=>{
                    $('#modalCadExistente').modal('hide')
                })
                $('#fecharId').on('click', ()=>{
                    $('#modalCadExistente').modal('hide')
                })
            })
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>