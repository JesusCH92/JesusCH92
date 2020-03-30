<?php

ini_set('display_errors', 1);
ini_set('display_starup_error', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

session_start(); // ! Iniciamos la sesion

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;

use App\Models\Job;
$container = new DI\Container();    // ! Contenedor de inyeccion de dependecias
$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => getenv('DB_HOST'),
    'database'  => getenv('DB_NAME'),
    'username'  => getenv('DB_USER'),
    'password'  => getenv('DB_PASS'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

// * Peticion 
$request = Zend\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);


// $route = $_GET['route'] ?? '/';
// if($route == '/'){
//     require '../index.php';
// }elseif($route == 'addJob'){
//     require '../addJob.php';
// }
// require '../index.php';
$routerContainer = new RouterContainer();
$map = $routerContainer->getMap();
//! $map->get('index', '/primer-proyecto-php/', '../index.php');
$map->get('index', '/primer-proyecto-php/', [
    'controller' => 'App\Controllers\IndexController',
    'action' => 'indexAction'
]);
$map->get('indexJobs', '/primer-proyecto-php/jobs', [
    'controller' => 'App\Controllers\JobsController',
    'action' => 'indexAction'
]);
$map->get('addJobs', '/primer-proyecto-php/jobs/delete', [
    'controller' => 'App\Controllers\JobsController',
    'action' => 'deleteAction'
]);
$map->get('deleteJobs', '/primer-proyecto-php/jobs', [
    'controller' => 'App\Controllers\JobsController',
    'action' => 'indexAction'
]);
$map->post('saveJobs', '/primer-proyecto-php/jobs/add', [
    'controller' => 'App\Controllers\JobsController',
    'action' => 'getAddjobAction'
]);
$map->get('addUser', '/primer-proyecto-php/users/add', [
    'controller' => 'App\Controllers\UsersController',
    'action' => 'getAddUser'
]);
$map->post('saveUser', '/primer-proyecto-php/users/save', [
    'controller' => 'App\Controllers\UsersController',
    'action' => 'postSaveUser'
]);
$map->get('loginForm', '/primer-proyecto-php/login', [
    'controller' => 'App\Controllers\AuthController',
    'action' => 'getLogin'
]);
$map->get('logout', '/primer-proyecto-php/logout', [
    'controller' => 'App\Controllers\AuthController',
    'action' => 'getLogout'
]);
$map->post('auth', '/primer-proyecto-php/auth', [
    'controller' => 'App\Controllers\AuthController',
    'action' => 'postLogin'
]);
$map->get('admin', '/primer-proyecto-php/admin', [
    'controller' => 'App\Controllers\AdminController',
    'action' => 'getIndex',
    'auth' => true
]);

$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);


if(!$route){
    echo 'No route!!';
}else{
    $handlerData = $route->handler;
// *array(2) { ["controller"]=> string(31) "App\Controllers\IndexController" ["action"]=> string(11) "indexAction" } 
    $controllerName = $handlerData['controller'];
    $actionName = $handlerData['action'];
    $needsAuth = $handlerData['auth'] ?? false; // !Si existe 'auth'
    
    $sesionUserId = $_SESSION['userId'] ?? false;
    var_dump($sesionUserId);    // ! Verificando la sesion
    if ($needsAuth && !$sesionUserId) {
        echo 'Protected route';
        die;
    }

//    if ($controllerName === 'App\Controllers\JobsController') {
//        $controller = new $controllerName(new \App\Services\JobService());
//    } else {
//        $controller = new $controllerName;
//    }
    $controller = $container->get($controllerName);
    

    $response = $controller->$actionName($request);

    foreach($response->getHeaders() as $name => $values){
        foreach($values as $value){
            header(sprintf('%s: %s', $name, $value), false);
        }
    }
    http_response_code($response->getStatusCode());
    echo $response->getBody();
}
