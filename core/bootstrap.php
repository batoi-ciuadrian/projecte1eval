<?php
ini_set('display_errors', 1);
require __DIR__.'/../vendor/autoload.php';
use cursophp7\core\App;
use cursophp7\core\Router;
use cursophp7\app\utils\MyLog;
use cursophp7\app\repository\UsuarioRepository;

session_start();

$config = require_once __DIR__.'/../app/config.php';
App::bind('config', $config);

$router = Router::load(__DIR__.'/../app/'.$config['routes']['filename']);
App::bind('router', $router);

$logger = MyLog::load(__DIR__.'/../logs/'.$config['logs']['filename'], $config['logs']['level']);
App::bind('logger', $logger);

if(isset($_SESSION['loguedUser'])) {
    $appUser = App::getRepository(UsuarioRepository::class)->find($_SESSION['loguedUser']);
} else {
    $appUser = null;
}

App::bind('appUser', $appUser);
