<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Request
 *
 * @author Adrian Ciucurenco
 */
namespace cursophp7\core;
class Request {
    public static function uri() {
        return trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),
                '/'
        );
    }
    
    public static function method() {
        return $_SERVER['REQUEST_METHOD'];
    }
}
