<?php
#API que altera os dados do autor

//não mostrar erros
error_reporting(~E_ALL & ~E_NOTICE & ~E_WARNING);

//autoload
include_once 'autoload.php';

if (isset($_GET['autor']) and isset($_GET['id_autor'])) {
    //o autor e o id foram passados como parametros
    try {
        //instanciar da classe
        $objAutor = new Autor();
        //invocar o método alterar
        $objAutor->alterarAutor($_GET['id_autor'], $_GET['autor']);
        //gerar o JSON
        print json_encode(['sucesso' => true]);
    } catch (PDOException $e) {
        //erro ao alterar
        print json_encode(['error' => $e->getMessage()]);
    }

} else {
    //o autor e o id nao foi passado no parametro
    print json_encode(['error' => "O nome eo id do autor sao obrigatório!"]);
}
