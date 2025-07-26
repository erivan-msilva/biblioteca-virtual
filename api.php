<?php
//definir o cabeçalho com arquivo json
header("Content-Type: application/json");

//não mostrar erros
error_reporting(~E_ALL & ~E_NOTICE & ~E_WARNING);
//definir token estático para exemplo
define('API_TOKEN','781e5e245d69b566979b86e28d23f2c7');

// Função para verificar se o token enviado é válido


function verificarToken($headers) {
    if (!isset($headers['Authorization'])) {
        return false;
    }

    // O formato esperado é: "Authorization: Bearer TOKEN"
    $authHeader = $headers['Authorization'];
    if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
        $token = $matches[1];
        return $token === API_TOKEN;
    }

    return false;
}

// Captura os headers da requisição
$headers = getallheaders();

// Verifica o token
#comentado porque a rede do SENAC não acessa api localmemte com token
// if (!verificarToken($headers)) {
//     http_response_code(401);
//     print json_encode(['erro' => 'Token inválido ou ausente.']);
//     exit;
// }

//Se chegou até aqui, o token é válido
//autoload
include_once 'autoload.php';

//seleecionar o tipo de ação: get, post, put ou delete
$method = $_SERVER['REQUEST_METHOD'];

//dados recebidos como parametro

$input = ($_SERVER['REQUEST_METHOD'] === 'GET') ? $_GET : json_decode(file_get_contents('php://input'), true);

//var_dump($input);
//incode -> envia dados para a API
//decode -> receber

//selecionar o método
switch($method) {
    case 'GET';
        //Consultar
        try {
            //instanciar a classe
           $objAutor = new Autor();
           //metodo para listar autores
           $autores = $objAutor->consultarAutor($_GET['nome']);
           //gerar o JSON
           print json_encode($autores);
       
        } catch (PDOException $e) {
            print json_encode(['error' => $e->getMessage()]);
        }
        break;
    case 'POST';
        //Inserir
        //verificar se o autor foi passado como paramento
        if (isset($input['nome'])) {
            //o autor foi passado como parametro
            try {
                //instanciar a classe
                $objAutor = new Autor();
                //invocar o método inserir
                $objAutor->inserirAutor($input['nome']);
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
            break;
    case 'PUT';
        //Alterar
        if (isset($input['nome']) and isset($input['id_autor'])) {
            //o autor e o id foram passados como parametros
            try {
                //instanciar da classe
                $objAutor = new Autor();
                //invocar o método alterar
                $objAutor->alterarAutor($input['id_autor'], $input['nome']);
                //gerar o JSON
                print json_encode(['sucesso' => true]);
            } catch (PDOException $e) {
                //erro ao alterar
                print json_encode(['error' => $e->getMessage()]);
            }
        
        } else {
            //o autor e o id nao foi passado no parametro
            print json_encode(['error' => "O nome e o id do tipo de serviço sao obrigatório!"]);
        }
        break;
    case 'DELETE';
        //deletar
        echo $_GET['id_autor'];
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
                break;
    default;
        //erro
        echo "MÉTODO NÃO ENCONTRADO!";
        break;


}