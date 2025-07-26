<?php
#API para inserir autor

//não mostrar erros
error_reporting(~E_ALL & ~E_NOTICE & ~E_WARNING);

//autoload
include_once 'autoload.php';

//verificar se o autor foi passado como paramento
if (isset($_GET['autor'])) {
    //o autor foi passado como parametro
    try {
        //instanciar a classe
        $objAutor = new Autor();
        //invocar o método inserir
        $objAutor->inserirAutor($_GET['autor']);
        //gerar o JSON
        print json_encode(['sucesso' => true]);

    } catch (PDOException $e) {
        //erro ao inserir
        print json_encode(['error' => $e->getMessage()]);
    }

} else {
    //o autor nao passado como parametro
    print json_encode(['error' => "O nome do autor é obrigatório!"]);
}
