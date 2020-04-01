<?php

require_once '../vendor/autoload.php';

session_start(); // ! Iniciamos la sesion

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

if (getenv('DEBUG') === 'true') {
    ini_set('display_errors', 1);
    ini_set('display_starup_error', 1);
    error_reporting(E_ALL);
}

use Illuminate\Database\Capsule\Manager as Capsule;
use Aura\Router\RouterContainer;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use WoohooLabs\Harmony\Harmony;
use WoohooLabs\Harmony\Middleware\LaminasEmitterMiddleware;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Zend\Diactoros\Response;
use WoohooLabs\Harmony\Middleware\DispatcherMiddleware;

$log = new Logger('app');  // ! Monolog-> Log Channel
$log->pushHandler(new StreamHandler(__DIR__ . '/../logs/app.log', Logger::WARNING));
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
$map->get('deleteJobs', '/primer-proyecto-php/jobs/delete', [
    'App\Controllers\JobsController',
    'deleteAction'
]);
$map->get('addJobs', '/primer-proyecto-php/jobs/add', [
    'App\Controllers\JobsController',
    'getAddJobAction'
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
    'getLogin'
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
    'getIndex'
]);
// ! Reto:
$map->get('changePassword', '/primer-proyecto-php/changePassword', [
    'App\Controllers\ResetPasswordController',
    'changePassword'
]);
$map->post('resetPassword', '/primer-proyecto-php/resetPassword', [
    'App\Controllers\ResetPasswordController',
    'resetPassword'
]);
$map->get('contactForm', '/primer-proyecto-php/contact', [
    'App\Controllers\ContactController',
    'index'
]);
$map->post('contactSend', '/primer-proyecto-php/contact/send', [
    'App\Controllers\ContactController',
    'send'
]);

$matcher = $routerContainer->getMatcher();
$route = $matcher->match($request);


if(!$route){
    echo 'No route!!';
}else{
    try{
        $harmony = new Harmony($request, new Response());
        $harmony
            ->addMiddleware(new LaminasEmitterMiddleware(new SapiEmitter()));
        if (getenv('DEBUG') === 'true') {
            $harmony
                ->addMiddleware(new \Franzl\Middleware\Whoops\WhoopsMiddleware());
        }
//            ->addMiddleware(new \Franzl\Middleware\Whoops\WhoopsMiddleware())
        $harmony->addMiddleware(new \App\Middlewares\AuthenticationMiddleware())    // ! Añadimos nuestro Middleware
            ->addMiddleware(new \Middlewares\AuraRouter($routerContainer))
            ->addMiddleware(new DispatcherMiddleware($container, 'request-handler'))
            ->run();
    } catch (Exception $e) {
        $log->warning($e->getMessage());
        $emitter = new SapiEmitter();
        $emitter->emit(new Response\EmptyResponse(400));
    } catch (Error $e) {
        $emitter = new SapiEmitter();
        $emitter->emit(new Response\EmptyResponse(500));
    }


}
