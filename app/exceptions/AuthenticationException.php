<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cursophp7\app\exceptions;
use cursophp7\app\exceptions\AppException;
/**
 * Description of AuthenticationException
 *
 * @author Adrian Ciucurenco
 */
class AuthenticationException extends AppException {
    public function __construct(string $message, int $code = 403) {
        parent::__construct($message, $code);
    }

}
