<?php
use cursophp7\app\exceptions\AppException;
use cursophp7\core\Request;
use cursophp7\core\App;

try {
    require __DIR__.'/../core/bootstrap.php';

    App::get('router')->direct(Request::uri(), Request::method());
} catch (AppException $ex) {
    $ex->handleError();
}
