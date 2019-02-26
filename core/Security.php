<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace cursophp7\core;
use cursophp7\core\App;
/**
 * Description of Security
 *
 * @author Adrian Ciucurenco
 */
class Security {
    public static function isUserGranted(string $role): bool {
        if($role === 'ROLE_ANONYMOUS') {
            return true;
        }
        
        $usuario = App::get('appUser');
        if(is_null($usuario)) {
            return false;
        }
        
        $valor_role = App::get('config')['security']['roles'][$role];
        $valor_role_usuario = App::get('config')['security']['roles'][$usuario->getRole()];
        return ($valor_role_usuario >= $valor_role);
    }
}
