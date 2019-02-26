<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotFoundException
 *
 * @author Adrian Ciucurenco
 */
namespace cursophp7\app\exceptions;
use cursophp7\app\exceptions\AppException;
class NotFoundException extends AppException {
    public function __construct(string $message, int $code = 404) {
        parent::__construct($message, $code);
    }
}
