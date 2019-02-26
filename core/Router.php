<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Router
 *
 * @author Adrian Ciucurenco
 */
namespace cursophp7\core;
use cursophp7\app\exceptions\NotFoundException;
use cursophp7\app\exceptions\AppException;
use cursophp7\core\Security;
use cursophp7\app\exceptions\AuthenticationException;

class Router {
    private $routes;

    private function __construct()
    {
        $this->routes = [
            'GET' => [],
            'POST' => []
        ];
    }

    public static function load(string $file): Router
    {
        $router = new Router();
        require $file;
        return $router;
    }

    public function get(string $uri, string $controller, $role = 'ROLE_ANONYMOUS')
    {
        $this->routes['GET'][$uri] = [
            'controller' => $controller,
            'role' => $role
        ];
    }

    public function post(string $uri, string $controller, $role = 'ROLE_ANONYMOUS')
    {
        $this->routes['POST'][$uri] = [
            'controller' => $controller,
            'role' => $role
        ];
    }

    private function callAction(string $controller, string $action, array $parameters): bool
    {
        try {
            $controller = App::get('config')['project']['namespace'] .
                    '\\app\\controllers\\' . $controller;
            $objController = new $controller();
            if (!method_exists($objController, $action))
                throw new NotFoundException(
                "El controlador $controller no responde al action $action");
            call_user_func_array(array($objController, $action), $parameters);
            return true;
        } catch (TypeError $typeError) {
            return false;
        }
    }

    private function getParametersRoute(string $route, array $matches)
    {
        preg_match_all('/:([^\/]+)/', $route, $parameterNames);
        $parameterNames = array_flip($parameterNames[1]);
        return array_intersect_key($matches, $parameterNames);
    }

    private function prepareRoute(string $route): string
    {
        $urlRule = preg_replace(
                '/:([^\/]+)/', '(?<\1>[^/]+)', $route);
        $urlRule = str_replace('/', '\/', $urlRule);
        return '/^' . $urlRule . '\/*$/s';
    }

    public function direct($uri, $method)
    {
        foreach ($this->routes[$method] as $route => $routeData) {
            $controller = $routeData['controller'];
            $minRole = $routeData['role'];
            $urlRule = $this->prepareRoute($route);
            if (preg_match($urlRule, $uri, $matches) === 1) {
                if(Security::isUserGranted($minRole) === false) {
                    if(!is_null(App::get('appUser'))) {
                        throw new AuthenticationException('Acceso no autorizado');
                    } else {
                        $this->redirect('login');
                    }
                } else {
                    $parameters = $this->getParametersRoute($route, $matches);
                    list($controller, $action) = explode('@', $controller);
                    if ($this->callAction($controller, $action, $parameters) === true)
                        return;
                }
                
            }
        }
        throw new NotFoundException('No se ha definido una ruta para esta URI '. $uri . ' ' . $method);
    }

    public function redirect($path)
    {
        header('location:/' . $path);
        
        exit();
    }
}
