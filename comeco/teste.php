<?php
session_start();
if(!isset($_SESSION['verificar']) && $_SESSION['verificar'] != 'verificado'){
    echo ' não pode mostrar';
}else{
    echo 'mostra ss';
    print_r($_SESSION);
}
// print_r($_SESSION);
?>
