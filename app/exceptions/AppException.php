<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppException
 *
 * @author Adrian Ciucurenco
 */

namespace cursophp7\app\exceptions;

use \Exception;
use cursophp7\core\Response;

class AppException extends Exception {

    public function __construct(string $message, $code = 500) {
        parent::__construct($message, $code);
    }

    private function getHttpHeaderMessage() {
        switch ($this->getCode()) {
            case 404:
                return '404 Not Found';
                
            case 403:
                return '403 Forbidden';
                
            case 500:
                return '500 Internal Server Error';
        }
    }

    public function handleError() {
        try {
            $httpHeaderMessage = $this->getHttpHeaderMessage();
            
            header($_SERVER['SERVER_PROTOCOL'].' '.$httpHeaderMessage, true, $this->getCode());
            
            $errorMessage = $this->getMessage();
            
            Response::renderView('error', 'layout', compact('httpHeaderMessage', 'errorMessage'));
            
        } catch (Exception $ex) {
            die('Se ha producido un error en nuestro manejador de excepciones');
        }
    }

}
