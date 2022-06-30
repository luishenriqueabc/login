<?php 

// Responde requisição de segurança para preflights (CORS) (Navegador)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");
    header("Access-Control-Allow-Headers: Access-Token");
    die;
}

require('config.php');                      

$url= $_SERVER['REQUEST_URI'];                           //Armazena na variavel "url" qual é a url buscada pelo cliente
$lengthStrFolder = strlen(BASE_URL_API);                //Mostra o valor da parte padrão da url EX: /LP2/
$urlClean = substr($url, $lengthStrFolder);             //Limpa a parte padrão da página conforme o seu tamanho armazenado em lengthStrFolder

$routeWithoutParameters = explode ("?" , $urlClean);               //Elimina parametros
$route = explode ("/" , $routeWithoutParameters[0]);              //Divide e url já limpa por barra 

//Carrega autoloaders
require(HELPERS_FOLDER.'autoloaders.php');

//Cria objeto de resposta da api
$response = new Output();

//Checa se o controller e a action existe na rota
if(!isset($route[0]) || !isset($route[1])) {
    $result['message'] = "404 - Rota da API não encontrada";
    $response->out($result, 404);
}

$controller_name = $route[0];
$action = str_replace('-', '', $route[1]);

$controller_path = CONTROLLERS_FOLDER. $controller_name .'Controller.php';

//Checa se o arquivo do controller existe
if(file_exists($controller_path)) {
    $controller_class_name = $controller_name. 'Controller';
    $controller = new $controller_class_name();
    //Checa se o action do controller existe
    if(method_exists($controller, $action)) {
        $controller->$action();
    }
}   

$result['message'] = "404 - Rota da API não encontrada";
$response->out($result, 404);
?>