<?php
//iniciar sessao
session_start();

//não mostrar erros
error_reporting(~E_ALL & ~E_NOTICE & ~E_WARNING);

//autoload
include_once 'autoload.php';

//validar sessao
$objController = new Controller();
if (!isset($_POST['recuperar_senha'])) {
    $objController->validarSessao();
}


//router
include_once 'router.php';
