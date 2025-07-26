<?php
#API que retorna todos os autores

//não mostrar erros
error_reporting(~E_ALL & ~E_NOTICE & ~E_WARNING);

//autoload
include_once 'autoload.php';

//
try {
     //instanciar a classe
    $objAutor = new Autor();
    //metodo para listar autores
    $autores = $objAutor->consultarAutor(null);
    //criar o header para JSON
    header('Content-Type: application/json');
    //gerar o JSON
    print json_encode($autores);

} catch (PDOException $e) {
    print json_encode(['error' => $e->getMessage()]);
}
