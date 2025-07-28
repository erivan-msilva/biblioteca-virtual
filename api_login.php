<?php
//definir o cabecalho como arquivo json
header("Content-Type: application/json");

//não mostrar erros
error_reporting(~E_ALL & ~E_NOTICE & ~E_WARNING);

// Define um token estático para exemplo
define('API_TOKEN', '781e5e245d69b566979b86e28d23f2c7');

// Função para verificar se o token enviado é válido
function verificarToken($headers)
{
    if (! isset($headers['Authorization'])) {
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
// if (! verificarToken($headers)) {
//     http_response_code(401);
//     print json_encode(['erro' => 'Token inválido ou ausente.']);
//     exit;
// }

//autoload
include_once 'autoload.php';

//capturar o tipo de ação da api: get, post, put ou delete
$method = $_SERVER['REQUEST_METHOD'];

//dados recebidos como parametro
$input = json_decode(file_get_contents('php://input'), true);

//selecionar o methodo
switch ($method) {
    case 'POST':
        //verificar se o autor foi passado como paramento
        if (isset($input['email']) and isset($input['senha'])) {
            //o autor foi passado como parametro
            try {
                //instanciar a classe
                $objUsuario = new Usuario();
                //invocar o método inserir
                if ($objUsuario->validarLogin($input['email'], $input['senha']) == true) {
                    //gerar o JSON
                    print json_encode(['sucesso' => true]);
                } else {
                    //gerar o JSON
                    print json_encode(['sucesso' => false]);
                }
            } catch (PDOException $e) {
                //erro ao inserir
                print json_encode(['error' => $e->getMessage()]);
            }
        } else {
            //o autor nao passado como parametro
            print json_encode(['error' => "Email e senha são obrigatórios"]);
        }
        break;
    default:
        //erro
        print "METODO NÃO ENCONTRADO!";
        break;
}
