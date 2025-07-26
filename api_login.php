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
        //Validar login
        try {
            //instanciar a classe
           $objLogin = new Usuario();
           //metodo para listar autores
           $resultado = $objLogin->validarLogin($_GET['email'], md5($_GET['senha']));
           //gerar o JSON
           $resultado = ["acesso" => $resultado ? "true" : "false"];
           print json_encode($resultado);
       
        } catch (PDOException $e) {
            print json_encode(['error' => $e->getMessage()]);
        }
        break;
   
    default;
        //erro
        echo "MÉTODO NÃO ENCONTRADO!";
        break;


}

// switch($method) {
//     case 'GET';
//         //Validar login
//         try {
//             //instanciar a classe
//            $objLogin = new Usuario();
//            //metodo para listar autores
//            $resultado = $objLogin->validarLogin($_GET['email'], md5($_GET['senha']));
//            //gerar o JSON
//            if($resultado==true){
//             $resultado =["acesso" => "true"];
//            } else{
//             $resultado =["acesso" => "false"];
//            }
//            print json_encode($resultado);
       
//         } catch (PDOException $e) {
//             print json_encode(['error' => $e->getMessage()]);
//         }
//         break;
   
//     default;
//         //erro
//         echo "MÉTODO NÃO ENCONTRADO!";
//         break;


// }