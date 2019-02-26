<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FileException
 *
 * @author Adrian Ciucurenco
 */
namespace cursophp7\app\exceptions;
use \Exception;
class FileException extends Exception {
    public function __construct(string $message) {
        parent::__construct($message);
    }
}
