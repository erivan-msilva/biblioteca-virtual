<?php
//não mostrar erros
error_reporting(~E_ALL & ~E_NOTICE & ~E_WARNING);

//autoload
include_once 'autoload.php';

//mostrar todos os livros
try {
    //criar objeto livro
    $objLivro = new Livro();
    $livro = $objLivro->consultarLivro(null, null);
    //criar o herader
    header('Content-Type: application/json');
    print json_encode($livro);
} catch (PDOException $e) {
    print json_encode(['error' => $e->getMessage()]);
}

