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
use WoohooLabs\Harmony\Harmony;
use WoohooLabs\Harmony\Middleware\LaminasEmitterMiddleware;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Zend\Diactoros\Response;
use WoohooLabs\Harmony\Middleware\DispatcherMiddleware;


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
    'App\Controllers\IndexController',
    'indexAction'
]);
$map->get('indexJobs', '/primer-proyecto-php/jobs', [
    'App\Controllers\JobsController',
    'indexAction'
]);
$map->get('addJobs', '/primer-proyecto-php/jobs/delete', [
    'App\Controllers\JobsController',
    'deleteAction'
]);
$map->get('deleteJobs', '/primer-proyecto-php/jobs', [
    'App\Controllers\JobsController',
    'indexAction'
]);
$map->post('saveJobs', '/primer-proyecto-php/jobs/add', [
    'App\Controllers\JobsController',
    'getAddjobAction'
]);
$map->get('addUser', '/primer-proyecto-php/users/add', [
    'App\Controllers\UsersController',
    'getAddUser'
]);
$map->post('saveUser', '/primer-proyecto-php/users/save', [
    'App\Controllers\UsersController',
    'postSaveUser'
]);
$map->get('loginForm', '/primer-proyecto-php/login', [
    'App\Controllers\AuthController',
    'action' => 'getLogin'
]);
$map->get('logout', '/primer-proyecto-php/logout', [
    'App\Controllers\AuthController',
    'getLogout'
]);
$map->post('auth', '/primer-proyecto-php/auth', [
    'App\Controllers\AuthController',
    'postLogin'
]);
$map->get('admin', '/primer-proyecto-php/admin', [
    'App\Controllers\AdminController',
    'getIndex',
    'auth' => true
]);

$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);


if(!$route){
    echo 'No route!!';
}else{
//    $handlerData = $route->handler;
//// *array(2) { ["controller"]=> string(31) "App\Controllers\IndexController" ["action"]=> string(11) "indexAction" }
//    $controllerName = $handlerData['controller'];
//    $actionName = $handlerData['action'];
//    $needsAuth = $handlerData['auth'] ?? false; // !Si existe 'auth'
//
//    $sesionUserId = $_SESSION['userId'] ?? false;
//    var_dump($sesionUserId);    // ! Verificando la sesion
//    if ($needsAuth && !$sesionUserId) {
//        echo 'Protected route';
//        die;
//    }
    $harmony = new Harmony($request, new Response());
    $harmony
        ->addMiddleware(new LaminasEmitterMiddleware(new SapiEmitter()))
        ->addMiddleware(new \Middlewares\AuraRouter($routerContainer))
        ->addMiddleware(new DispatcherMiddleware($container, 'request-handler'))
        ->run();

}
