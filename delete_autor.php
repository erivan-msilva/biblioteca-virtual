<?php
#API que exclui autor

//não mostrar erros
error_reporting(~E_ALL & ~E_NOTICE & ~E_WARNING);

//autoload
include_once 'autoload.php';

//verificar se o id foi passado no parametro
if (isset($_GET['id_autor'])) {
    //o id foi passado no parametro
    try {
        //instanciar da classe
        $objAutor = new Autor();
        //invocar o método excluir
        $objAutor->excluirAutor($_GET['id_autor']);
        //gerar o JSON
        print json_encode(['sucesso' => true]);
    } catch (PDOException $e) {
        //erro ao excluir
        print json_encode(['error' => $e->getMessage()]);
    }

} else {
    //o id nao foi passado no parametro
    print json_encode(['error' => "O id é obrigatório!"]);
}
