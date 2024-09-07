<?php
$listaUser = 'verdadeiro';
require_once 'controller.php';
?>

if (i > 0) {
                                            console.log('pedidos anterior', pedidos[i-1].id_user2)
                                            console.log('pedidos atual', pedido.id_user2) //aqui é do que está logado 
                                            console.log(<?php echo $users->usuario_id?>) //aqui está o id do usuário que não é o que está logado
                                            if (pedidos[i - 1].id_user2 != <?php echo $users->usuario_id ?> && pedido.id_user2 != <?php echo $users->usuario_id ?>) {
                                                $('#btn<?php echo $users->usuario_id ?>').html('Adicionar')
                                                $('#btn<?php echo $users->usuario_id ?>').attr('class', 'btn btn-success')
                                                $('#btn<?php echo $users->usuario_id ?>').click(() => {
                                                    window.location.href = "controller.php?acao=fazerPedido&user_id=<?php echo $users->usuario_id ?>"
                                                }
                                            )
                                            console.log('adicionar');
                                            }else if(pedido.visualizar ==1) {
                                                $('#td<?php echo $users->usuario_id ?>').attr('style', 'display:none')
                                            }else{
                                                $('#btn<?php echo $users->usuario_id ?>').html('Remover')
                                                $('#btn<?php echo $users->usuario_id ?>').attr('class', 'btn btn-danger')
                                                $('#btn<?php echo $users->usuario_id ?>').click(() => {
                                                    window.location.href = "controller.php?acao=desFazerPedido&user_id=<?php echo $users->usuario_id ?>"
                                                }
                                                )
                                                console.log('remover')
                                            }
                                        }else{
                                            if (pedido.id_user2 != <?php echo $users->usuario_id ?>) {
                                                console.log('chegou adicionar')
                                                $('#btn<?php echo $users->usuario_id ?>').html('Adicionar')
                                                $('#btn<?php echo $users->usuario_id ?>').attr('class', 'btn btn-success')
                                                $('#btn<?php echo $users->usuario_id ?>').click(() => {
                                                    window.location.href = "controller.php?acao=fazerPedido&user_id=<?php echo $users->usuario_id ?>"
                                                }
                                                )
                                            } else if (pedido.id_user2 == <?php echo $users->usuario_id ?> && pedido.visualizar == 0) {
                                                console.log('chegou remover')
                                                $('#btn<?php echo $users->usuario_id ?>').html('Remover')
                                                $('#btn<?php echo $users->usuario_id ?>').attr('class', 'btn btn-danger')
                                                $('#btn<?php echo $users->usuario_id ?>').click(() => {
                                                    window.location.href = "controller.php?acao=desFazerPedido&user_id=<?php echo $users->usuario_id ?>"
                                                }
                                                )
                                            } else {
                                                $('#td<?php echo $users->usuario_id ?>').attr('style', 'display:none')
                                            }
                                        }
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>